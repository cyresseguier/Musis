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
     * @ORM\ManyToMany(targetEntity="Music", mappedBy="artists", cascade={"persist"})
     **/
    private $musics;

  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musics = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add musics
     *
     * @param \Team\MusisBundle\Entity\Music $musics
     * @return Artist
     */
    public function addMusic(\Team\MusisBundle\Entity\Music $musics)
    {
        $this->musics[] = $musics;

        return $this;
    }

    /**
     * Remove musics
     *
     * @param \Team\MusisBundle\Entity\Music $musics
     */
    public function removeMusic(\Team\MusisBundle\Entity\Music $musics)
    {
        $this->musics->removeElement($musics);
    }

    /**
     * Get musics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMusics()
    {
        return $this->musics;
    }
}
