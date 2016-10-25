<?php

// src/AppBundle/Controller/PublicoController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicoController extends Controller
{
    /**
     * @Route("/inicio")
     */
    public function paginaInicial()
    {
    	return $this->render('publico/inicio.html.twig');
    }
}