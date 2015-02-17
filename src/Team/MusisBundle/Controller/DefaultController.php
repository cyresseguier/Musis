<?php

namespace Team\MusisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('TeamMusisBundle:Musis:index.html.twig',
        	array( 
        	));
    }
}
