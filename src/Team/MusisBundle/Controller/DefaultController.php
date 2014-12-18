<?php

namespace Team\MusisBundle\Controller;

use Team\MusisBundle\Entity\Music;
use Team\MusisBundle\Entity\Artist;
use Team\MusisBundle\Entity\Place;
use Team\MusisBundle\Entity\Playlist;
use Team\MusisBundle\Entity\Description;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$artisttest=new Artist();
    	$artisttest->setName("DJ Kharlamm");

    	$placetest=new Place();
    	$placetest->setName("Tour Eiffel");
    	$placetest->setCoordLong(50.11111);
    	$placetest->setCoordLat(59.22222);

    	$playlisttest=new Playlist();
    	$playlisttest->setName("Playlist dans le turfu");
    	$playlisttest->setPresentation("Lorem ipsum test test test test");

    	$descriptiontest= new Description();
    	$descriptiontest->setImage("src/test/img/img.png");
    	$descriptiontest->setContent("Ici la description de la musique");

    	$musictest= new Music();
    	$musictest->setTitle("From Paris to Berlin");
    	$musictest->addArtist($artisttest);
    	$musictest->setAlbum("IMACCMWAlbum");
    	$musictest->addPlace($placetest);
    	$musictest->addPlaylist($playlisttest);
    	$musictest->setDescription($descriptiontest);
    	$musictest->setYear(2015);
    	$musictest->setLink("http://musica.com");

    	// On récupère l'EntityManager
    	$em = $this->getDoctrine()->getManager();
	    // Étape 1 : On « persiste » l'entité
	    //$em->persist($musictest);
	    // Étape 2 : On « flush » tout ce qui a été persisté avant pour l'enregistrer dans la BDD
	    //$em->flush();

        return $this->render('TeamMusisBundle:Musis:index.html.twig',
        	array( 
        		'music'=>$musictest
        	));
    }
}
