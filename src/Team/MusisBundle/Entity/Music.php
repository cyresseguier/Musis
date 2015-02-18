<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Music
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Team\MusisBundle\Entity\Repository\MusicRepository")
 */
class Music
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="album", type="string", length=255)
     */
    private $album;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="smallint")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="lyrics", type="string", length=255)
     */
    private $lyrics;

    /**
     * @ORM\OneToMany(targetEntity="Team\MusisBundle\Entity\MusicPlace", mappedBy="music", cascade={"persist"})
     */
    private $musicsPlaces;

    /**
     * @ORM\OneToMany(targetEntity="Team\MusisBundle\Entity\MusicArtist", mappedBy="music", cascade={"persist"})
     */
    private $musicsArtists;

    /**
     * @ORM\OneToMany(targetEntity="Team\MusisBundle\Entity\MusicPlaylist", mappedBy="music", cascade={"persist"})
     */
    private $musicsPlaylists;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musicsPlaces = new \Doctrine\Common\Collections\ArrayCollection();
        $this->musicsArtists = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Music
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set album
     *
     * @param string $album
     * @return Music
     */
    public function setAlbum($album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return string 
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Music
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Music
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set lyrics
     *
     * @param string $lyrics
     * @return Music
     */
    public function setLyrics($lyrics)
    {
        $this->lyrics = $lyrics;

        return $this;
    }

    /**
     * Get lyrics
     *
     * @return string 
     */
    public function getLyrics()
    {
        return $this->lyrics;
    }

    /**
     * Add musicsPlaces
     *
     * @param \Team\MusisBundle\Entity\MusicPlace $musicsPlaces
     * @return Music
     */
    public function addMusicsPlace(\Team\MusisBundle\Entity\MusicPlace $musicsPlaces)
    {
        $this->musicsPlaces[] = $musicsPlaces;

        return $this;
    }

    /**
     * Remove musicsPlaces
     *
     * @param \Team\MusisBundle\Entity\MusicPlace $musicsPlaces
     */
    public function removeMusicsPlace(\Team\MusisBundle\Entity\MusicPlace $musicsPlaces)
    {
        $this->musicsPlaces->removeElement($musicsPlaces);
    }

    /**
     * Get musicsPlaces
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMusicsPlaces()
    {
        return $this->musicsPlaces;
    }

    /**
     * Add musicsArtists
     *
     * @param \Team\MusisBundle\Entity\MusicArtist $musicsArtists
     * @return Music
     */
    public function addMusicsArtist(\Team\MusisBundle\Entity\MusicArtist $musicsArtists)
    {
        $this->musicsArtists[] = $musicsArtists;

        return $this;
    }

    /**
     * Remove musicsArtists
     *
     * @param \Team\MusisBundle\Entity\MusicArtist $musicsArtists
     */
    public function removeMusicsArtist(\Team\MusisBundle\Entity\MusicArtist $musicsArtists)
    {
        $this->musicsArtists->removeElement($musicsArtists);
    }

    /**
     * Get musicsArtists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMusicsArtists()
    {
        return $this->musicsArtists;
    }

    /**
     * Add musicsPlaylists
     *
     * @param \Team\MusisBundle\Entity\MusicPlaylist $musicsPlaylists
     * @return Music
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
}
