<?php

namespace Team\MusisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * Music
 * @ORM\Table(name="music_playlist")
 * @ORM\Entity
 */
class MusicPlaylist
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
     * @ORM\ManyToOne(targetEntity="Team\MusisBundle\Entity\Music", inversedBy="musicsPlaylists")
     */
    private $music;
 
    /**
     * @ORM\ManyToOne(targetEntity="Team\MusisBundle\Entity\Playlist", inversedBy="musicsPlaylists")
     */
    private $playlist;


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
     * @return MusicPlaylist
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
     * Set playlist
     *
     * @param \Team\MusisBundle\Entity\Playlist $playlist
     * @return MusicPlaylist
     */
    public function setPlaylist(\Team\MusisBundle\Entity\Playlist $playlist = null)
    {
        $this->playlist = $playlist;

        return $this;
    }

    /**
     * Get playlist
     *
     * @return \Team\MusisBundle\Entity\Playlist 
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    public function __toString() 
    {
        return (String) $this->getPlaylist();
    }
}
