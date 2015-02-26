<?php

namespace Team\MusisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$musics = $this
		  ->getDoctrine()
		  ->getRepository('TeamMusisBundle:Music')
		  ->findAll();
		
        return $this->render('TeamMusisBundle:Musis:index.html.twig',
        	array(
        		'musics'=>$musics
        	));
    }
}
