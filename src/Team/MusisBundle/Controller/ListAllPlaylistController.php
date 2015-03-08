<?php

namespace Team\MusisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListAllPlaylistController extends Controller
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
    
        return $this->render('TeamMusisBundle:Musis:playlist.html.twig',array(
                'playlist_name'=>$name, 'playlist'=>$musics
            ));
    }
}
