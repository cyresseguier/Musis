<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Place
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Team\MusisBundle\Entity\Repository\PlaceRepository")
 */
class Place
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
     * @var float
     *
     * @ORM\Column(name="coordLong", type="float")
     */
    private $coordLong;

    /**
     * @var float
     *
     * @ORM\Column(name="coordLat", type="float")
     */
    private $coordLat;

    /**
     * @ORM\OneToMany(targetEntity="Team\MusisBundle\Entity\MusicPlace", mappedBy="place", cascade={"persist"})
     */
    private $musicsPlaces;
 
   

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musicsPlaces = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Place
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
     * Set coordLong
     *
     * @param float $coordLong
     * @return Place
     */
    public function setCoordLong($coordLong)
    {
        $this->coordLong = $coordLong;

        return $this;
    }

    /**
     * Get coordLong
     *
     * @return float 
     */
    public function getCoordLong()
    {
        return $this->coordLong;
    }

    /**
     * Set coordLat
     *
     * @param float $coordLat
     * @return Place
     */
    public function setCoordLat($coordLat)
    {
        $this->coordLat = $coordLat;

        return $this;
    }

    /**
     * Get coordLat
     *
     * @return float 
     */
    public function getCoordLat()
    {
        return $this->coordLat;
    }

    /**
     * Add musicsPlaces
     *
     * @param \Team\MusisBundle\Entity\MusicPlace $musicsPlaces
     * @return Place
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

    public function __toString()
    {
        return (string) $this->getName();
    }
}
