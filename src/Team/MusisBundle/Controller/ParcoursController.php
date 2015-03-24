<?php

namespace Team\MusisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParcoursController extends Controller
{
    public function indexAction($name)
    {	
        $orm=$this->getDoctrine();
        $playlist=$orm
            ->getRepository('TeamMusisBundle:Playlist')
            ->findOneBy(array('name' => $name));
        $playlist_id=$playlist->getId();
        $musics=$orm
            ->getRepository('TeamMusisBundle:MusicPlaylist')
            ->findBy(array('playlist' => $playlist_id));
            
        return $this->render('TeamMusisBundle:Musis:parcours.html.twig',array(
                'playlistInfo'=>$playlist, 'playlist'=>$musics
            ));
    }
}
