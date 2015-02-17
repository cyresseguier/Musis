<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Team\MusisBundle\Entity\Repository\PlaylistRepository")
 */
class Playlist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text")
     */
    private $presentation;

     /**
     * @ORM\OneToMany(targetEntity="Team\MusisBundle\Entity\MusicPlaylist", mappedBy="playlist", cascade={"persist"})
     */
    private $musicsPlaylists;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musicsPlaylists = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Playlist
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     * @return Playlist
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string 
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Add musicsPlaylists
     *
     * @param \Team\MusisBundle\Entity\MusicPlaylist $musicsPlaylists
     * @return Playlist
     */
    public function addMusicsPlaylist(\Team\MusisBundle\Entity\MusicPlaylist $musicsPlaylists)
    {
        $this->musicsPlaylists[] = $musicsPlaylists;

        return $this;
    }

    /**
     * Remove musicsPlaylists
     *
     * @param \Team\MusisBundle\Entity\MusicPlaylist $musicsPlaylists
     */
    public function removeMusicsPlaylist(\Team\MusisBundle\Entity\MusicPlaylist $musicsPlaylists)
    {
        $this->musicsPlaylists->removeElement($musicsPlaylists);
    }

    /**
     * Get musicsPlaylists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMusicsPlaylists()
    {
        return $this->musicsPlaylists;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }
}
