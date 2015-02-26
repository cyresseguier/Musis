<?php

namespace Team\MusisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$places = $this
		  ->getDoctrine()
		  ->getRepository('TeamMusisBundle:Place')
		  ->findAll();
		
        return $this->render('TeamMusisBundle:Musis:index.html.twig',
        	array(
        		'places'=>$places
        	));
    }
}
