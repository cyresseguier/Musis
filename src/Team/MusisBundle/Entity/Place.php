<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Place
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Team\MusisBundle\Entity\PlaceRepository")
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
}
