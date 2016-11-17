<?php

namespace VisaoIBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use VisaoIBundle\Entity\Provas;
use Doctrine\ORM\EntityManager;

class ProvasController extends Controller
{
	/**
	* @Route ("/provas", name="provas")
	* @Method({"GET", "POST"})
	*/
	public function indexAction(Request $request)
    {
    	/** @variavel EntityManager $em */
    	$em = $this->getDoctrine()->getManager();
    	$prova = new Provas();

    	$form = $this->createFormBuilder($prova)
    		->setAction($this->generateUrl('provas'))
    		->setMethod('POST')
    		->add('materia', TextType::class)
    		->add('data_prova', DateType::class, array(
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

    		$prova->setUser($user);

    		$em->persist($prova);
    		$em->flush();
    		$this->addFlash('notice', 'Prova adicionada!');

    		return $this->redirectToRoute('provas');
    	}

    	$prova = $em->getRepository('VisaoIBundle:Provas')->findByUser($user->getId());

        return $this->render('VisaoIBundle:Provas:index.html.twig', array(
        	'form' => $form->createView(),
        	'provas' => $prova
    	));
    }


    /**
    * @Route("/deleta-prova/{id}", name="prova-deletada")
    * @Method({"GET", "POST"})
    */ 
     public function deletaAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

        $prova = $em->getRepository('VisaoIBundle:Provas')->find($id);

    	if (!$prova) {
    		$this->addFlash('error', 'Prova não encontrada');

    		return $this->redirectToRoute('provas');
    	}

    	$em->remove($prova);
    	$em->flush();

    	return $this->redirectToRoute('provas');
    }

}