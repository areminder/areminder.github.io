<?php

namespace VisaoIBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use VisaoIBundle\Entity\Notas;
use Doctrine\ORM\EntityManager;

class NotasController extends Controller
{
	/**
	* @Route ("/notas", name="notas")
	* @Method({"GET", "POST"})
	*/
	public function indexAction(Request $request)
    {
    	/** @variavel EntityManager $em */
    	$em = $this->getDoctrine()->getManager();
    	$nota = new Notas();

    	$form = $this->createFormBuilder($nota)
    		->setAction($this->generateUrl('notas'))
    		->setMethod('POST')
    		->add('descricao', TextareaType::class)
    		->add('data_criacao', DateType::class, array(
    		    'attr' => ['class' => 'js-datepicker'],
    			'widget' => 'single_text'))
    		->getForm();

    	$form->handleRequest($request);

		$user = $this->get('security.token_storage')->getToken()->getUser();
    	if ($form->isValid()) {

    		$nota->setUser($user);

    		$em->persist($nota);
    		$em->flush();
    		$this->addFlash('notice', 'Nota adicionada!');

    		return $this->redirectToRoute('notas');
    	}

    	$notas = $em->getRepository('VisaoIBundle:Notas')->findByUser($user->getId());

        return $this->render('VisaoIBundle:Notas:index.html.twig', array(
        	'form' => $form->createView(),
        	'notas' => $notas
    	));
    }
}