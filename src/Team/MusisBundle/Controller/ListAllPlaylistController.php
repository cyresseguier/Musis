<?php

namespace Team\MusisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListAllPlaylistController extends Controller
{
    public function indexAction()
    {	
        return $this->render('TeamMusisBundle:Musis:playlist.html.twig');
    }
}
