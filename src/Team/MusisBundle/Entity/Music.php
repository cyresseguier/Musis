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
     * @ORM\ManyToMany(targetEntity="Place", inversedBy="musics", cascade={"persist"})
     * @ORM\JoinTable(name="musics_places")
     **/
    private $places;

    /**
     * @ORM\ManyToMany(targetEntity="Artist", inversedBy="musics", cascade={"persist"})
     * @ORM\JoinTable(name="musics_artists")
     **/
    private $artists;

    /**
     * @ORM\ManyToMany(targetEntity="Playlist", inversedBy="musics", cascade={"persist"})
     * @ORM\JoinTable(name="musics_playlists")
     **/
    private $playlists;

    /**
     * @ORM\OneToOne(targetEntity="Description", cascade={"persist"})
     **/
    private $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
        $this->artists = new \Doctrine\Common\Collections\ArrayCollection();
        $this->playlists = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add places
     *
     * @param \Team\MusisBundle\Entity\Place $places
     * @return Music
     */
    public function addPlace(\Team\MusisBundle\Entity\Place $places)
    {
        $this->places[] = $places;

        return $this;
    }

    /**
     * Remove places
     *
     * @param \Team\MusisBundle\Entity\Place $places
     */
    public function removePlace(\Team\MusisBundle\Entity\Place $places)
    {
        $this->places->removeElement($places);
    }

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Add artists
     *
     * @param \Team\MusisBundle\Entity\Artist $artists
     * @return Music
     */
    public function addArtist(\Team\MusisBundle\Entity\Artist $artists)
    {
        $this->artists[] = $artists;

        return $this;
    }

    /**
     * Remove artists
     *
     * @param \Team\MusisBundle\Entity\Artist $artists
     */
    public function removeArtist(\Team\MusisBundle\Entity\Artist $artists)
    {
        $this->artists->removeElement($artists);
    }

    /**
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * Add playlists
     *
     * @param \Team\MusisBundle\Entity\Playlist $playlists
     * @return Music
     */
    public function addPlaylist(\Team\MusisBundle\Entity\Playlist $playlists)
    {
        $this->playlists[] = $playlists;

        return $this;
    }

    /**
     * Remove playlists
     *
     * @param \Team\MusisBundle\Entity\Playlist $playlists
     */
    public function removePlaylist(\Team\MusisBundle\Entity\Playlist $playlists)
    {
        $this->playlists->removeElement($playlists);
    }

    /**
     * Get playlists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }

    /**
     * Set description
     *
     * @param \Team\MusisBundle\Entity\Description $description
     * @return Music
     */
    public function setDescription(\Team\MusisBundle\Entity\Description $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return \Team\MusisBundle\Entity\Description 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
