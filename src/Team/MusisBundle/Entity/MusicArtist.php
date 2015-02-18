<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  Music
 * @ORM\Table(name="music_artist")
 * @ORM\Entity
 */
class MusicArtist
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
     * @ORM\ManyToOne(targetEntity="Team\MusisBundle\Entity\Music", inversedBy="musicsArtists")
     */
    private $music;
 
    /**
     * @ORM\ManyToOne(targetEntity="Team\MusisBundle\Entity\Artist", inversedBy="musicsArtists")
     */
    private $artist;



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
     * @return MusicArtist
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
     * Set artist
     *
     * @param \Team\MusisBundle\Entity\Artist $artist
     * @return MusicArtist
     */
    public function setArtist(\Team\MusisBundle\Entity\Artist $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \Team\MusisBundle\Entity\Artist 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    public function __toString() 
    {
        return (String) $this->getArtist();
    }
}
