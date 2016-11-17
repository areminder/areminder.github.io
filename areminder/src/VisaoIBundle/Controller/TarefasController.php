<?php

namespace VisaoIBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VisaoIBundle\Entity\Tarefas;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
    		->getForm();

    	$form->handleRequest($request);

		$user = $this->get('security.token_storage')->getToken()->getUser();
    	if ($form->isValid()) {

    		$tarefa->setUser($user);

    		$em->persist($tarefa);
    		$em->flush();
    		$this->addFlash('notice', 'Tarefa adiciona!');

    		return $this->redirectToRoute('tarefas');
    	}

    	$tarefas = $em->getRepository('VisaoIBundle:Tarefas')->findByUser($user->getId());

        return $this->render('VisaoIBundle:Tarefas:index.html.twig', array(
        	'form' => $form->createView(),
        	'tarefas' => $tarefas
    	));
    }
}
