<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
	/**
	* @Route ("/", name="inicio")
	*/
    public function indexAction()
    {
        return $this->render('MainBundle:Default:inicio.html.twig');
    }
}
