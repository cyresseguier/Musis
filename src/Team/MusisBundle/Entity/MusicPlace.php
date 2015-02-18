<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Music
 *
 * @ORM\Table(name="music_place")
 * @ORM\Entity
 */
class MusicPlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
 
    /**
     * @ORM\ManyToOne(targetEntity="Team\MusisBundle\Entity\Music", inversedBy="musicsPlaces")
     */
    private $music;
 
    /**
     * @ORM\ManyToOne(targetEntity="Team\MusisBundle\Entity\Place", inversedBy="musicsPlaces")
     */
    private $place;




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
     * Set music
     *
     * @param \Team\MusisBundle\Entity\Music $music
     * @return MusicPlace
     */
    public function setMusic(\Team\MusisBundle\Entity\Music $music = null)
    {
        $this->music = $music;

        return $this;
    }

    /**
     * Get music
     *
     * @return \Team\MusisBundle\Entity\Music 
     */
    public function getMusic()
    {
        return $this->music;
    }

    /**
     * Set place
     *
     * @param \Team\MusisBundle\Entity\Place $place
     * @return MusicPlace
     */
    public function setPlace(\Team\MusisBundle\Entity\Place $place = null)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return \Team\MusisBundle\Entity\Place 
     */
    public function getPlace()
    {
        return $this->place;
    }

    public function __toString() 
    {
        return (String) $this->getPlace();
    }
}
