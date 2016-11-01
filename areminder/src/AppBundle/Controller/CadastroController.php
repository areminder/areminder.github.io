<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Usuario;

class CadastroController extends Controller
{
    /**
     * @Route("/registro")
     */
    public function indexAction()
    {
        return $this->render('cadastro/registro.html.twig');
    }

    public function signupAction(Request $request)
    {
    	if($request->getMethod() == 'POST'){
    		echo "<pre>";print_r($request);die;

    	}
	    	

	// echo "<pre>";print_r($request);die;
	// $usuario = new Usuario();
	// $usuario->setNickname($request->get('username'));
	// // $usuario->setEmail($request->get('email'));
	// // $usuario->setPassword($request->get('password'));
 // //    // replace this example code with whatever you need

 //    $em = $this->getDoctrine()->getEntityManager();
 //    $em->persist($usuario);
 //    $em->flush($usuario);

 //     return $this->render('cadastro/registro.html.twig');
    }
    	
}