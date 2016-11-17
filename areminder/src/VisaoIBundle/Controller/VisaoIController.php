<?php

namespace VisaoIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VisaoIController extends Controller
{
	/**
	* @Route ("/visao-geral", name="visao-geral")
	*/
    public function indexAction()
    {
        return $this->render('VisaoIBundle:Default:visao.html.twig');
    }
}
