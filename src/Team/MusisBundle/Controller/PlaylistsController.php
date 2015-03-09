<?php

namespace Team\MusisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlaylistsController extends Controller
{
     public function indexAction()
    {
        $orm=$this->getDoctrine();

        $musics = $orm
          ->getRepository('TeamMusisBundle:Music')
          ->findAll();

        $playlists = $orm
          ->getRepository('TeamMusisBundle:Playlist')
          ->findAll();
        
        return $this->render('TeamMusisBundle:Musis:playlists.html.twig',
            array(
                'musics'=>$musics,
                'playlists'=>$playlists
            ));
    }
}
