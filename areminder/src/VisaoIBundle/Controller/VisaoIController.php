<?php

namespace VisaoIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VisaoIBundle\Entity\Tarefas;
use VisaoIBundle\Entity\Notas;
use VisaoIBundle\Entity\Provas;

class VisaoIController extends Controller
{
	/**
	* @Route ("/visao-geral", name="visao-geral")
	*/
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

    	$user = $this->get('security.token_storage')->getToken()->getUser();

    	/**
    	* Traz todas as tarefas não finalizadas do usuário logado.
    	*/
    	$tarefas_pendentes = $em->getRepository('VisaoIBundle:Tarefas')->findByUser($user->getId());
    	$tarefas_pendentes = $em->getRepository('VisaoIBundle:Tarefas')->findByFinalizada(false);
    	$notas = $em->getRepository('VisaoIBundle:Notas')->findByUser($user->getId());
    	$provas = $em->getRepository('VisaoIBundle:Provas')->findByUser($user->getId());

    	/**
    	* Retorna para a view, o array de tarefas selecionadas anteriormente.
    	*/
    	return $this->render('VisaoIBundle:Default:visao.html.twig', array(
            'tarefasP' => $tarefas_pendentes,
            'notas' => $notas,
            'provas' => $provas
        ));
    }
}
