<?php

namespace VisaoIBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use VisaoIBundle\Entity\Tarefas;
use Doctrine\ORM\EntityManager;

class TarefasController extends Controller
{
	/**
	* @Route ("/tarefas", name="tarefas")
	* @Method({"GET", "POST"})
	*/
    public function indexAction(Request $request)
    {
    	/** @variavel EntityManager $em */
    	$em = $this->getDoctrine()->getManager();
    	$tarefa = new Tarefas();
    	$tarefa->setDataCriacao(new \DateTime());

    	$form = $this->createFormBuilder($tarefa)
    		->setAction($this->generateUrl('tarefas'))
    		->setMethod('POST')
    		->add('descricao', TextType::class)
    		->add('data_finaliza', DateType::class, array(
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

    		$tarefa->setUser($user);

    		$em->persist($tarefa);
    		$em->flush();
            $this->addFlash('notice', 'Tarefa adicionada!');

    		return $this->redirectToRoute('tarefas');
    	}

    	$tarefas = $em->getRepository('VisaoIBundle:Tarefas')->findByUser($user->getId());

        return $this->render('VisaoIBundle:Tarefas:index.html.twig', array(
            'form' => $form->createView(),
            'tarefas' => $tarefas
        ));

    }

    /**
    * @Route("/muda-status/{id}", name="tarefa-concluida")
    * @Method({"GET", "POST"})
    */ 
    public function finalizaAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$tarefa = $em->getRepository('VisaoIBundle:Tarefas')->find($id);

    	if (!$tarefa) {
    		$this->addFlash('error', 'Tarefa não encontrada');

    		return $this->redirectToRoute('tarefas');
    	}

    	$tarefa->setFinalizada(! $tarefa->isFinalizada());
    	$em->flush();

    	return $this->redirectToRoute('tarefas');
    }

   	/**
    * @Route("/deleta-tarefa/{id}", name="tarefa-deletada")
    * @Method({"GET", "POST"})
    */ 
    public function deletaAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$tarefa = $em->getRepository('VisaoIBundle:Tarefas')->find($id);

    	if (!$tarefa) {
    		$this->addFlash('error', 'Tarefa não encontrada');

    		return $this->redirectToRoute('tarefas');
    	}

    	$em->remove($tarefa);
    	$em->flush();

    	return $this->redirectToRoute('tarefas');
    }
}
