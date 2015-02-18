<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artist
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Team\MusisBundle\Entity\Repository\ArtistRepository")
 */
class Artist
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
     * @ORM\OneToMany(targetEntity="Team\MusisBundle\Entity\MusicArtist", mappedBy="artist", cascade={"persist"})
     */
    private $musicsArtists;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musicsArtists = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Artist
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
     * Add musicsArtists
     *
     * @param \Team\MusisBundle\Entity\MusicArtist $musicsArtists
     * @return Artist
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

    public function __toString()
    {
        return (string) $this->getName();
    }
}
