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
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => 'false',
                'attr' => array(
                    'class' => 'datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd/mm/yyyy')))
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

   	/**
    * @Route("/deleta-nota/{id}", name="nota-deletada")
    * @Method({"GET", "POST"})
    */ 
    public function deletaAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

        $nota = $em->getRepository('VisaoIBundle:Notas')->find($id);

    	if (!$nota) {
    		$this->addFlash('error', 'Nota não encontrada');

    		return $this->redirectToRoute('notas');
    	}

    	$em->remove($nota);
    	$em->flush();

    	return $this->redirectToRoute('notas');
    }

}