<?php

namespace VisaoIBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
    	return $this->render('VisaoIBundle:Provas:index.html.twig');
    }
}