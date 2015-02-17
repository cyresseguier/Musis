<?php
 
namespace Team\MusisBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
 
class MusicAdmin extends Admin
{
    // Patch for One to Many Actions
    public function prePersist($music)
    {
        foreach ($music->getMusicsArtists() as $musicsArtists) {
            $musicsArtists->setMusic($music);
        }
        foreach ($music->getMusicsPlaces() as $musicsPlaces) {
            $musicsPlaces->setMusic($music);
        }
        foreach ($music->getMusicsPlaylists() as $musicsPlaylists) {
            $musicsPlaylists->setMusic($music);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($music)
    {
        foreach ($music->getMusicsArtists() as $musicsArtists) {
            $musicsArtists->setMusic($music);
        }
        foreach ($music->getMusicsPlaces() as $musicsPlaces) {
            $musicsPlaces->setMusic($music);
        }
        foreach ($music->getMusicsPlaylists() as $musicsPlaylists) {
            $musicsPlaylists->setMusic($music);
        }
    }


    

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('album')
            ->add('year')
            ->add('link')
            ->add('lyrics')
            ->add( 'musicsArtists','sonata_type_collection', array(
                'label' => 'Artist',
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
                ))
            ->add( 'musicsPlaylists','sonata_type_collection', array(
                'label' => 'Playlist',
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
                ))
            ->add( 'musicsPlaces','sonata_type_collection', array(
                'label' => 'Place',
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
                ))
        ;
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('album')
            ->add('year')
            ->add('link')
            ->add('lyrics')
            ->add('musicsPlaces', 'sonata_type_collection', array(
                'label' => 'Place',
                'by_reference' => false 
                ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
                ))
            ->add('musicsArtists', 'sonata_type_collection', array(
                'label' => 'Artist',
                'by_reference' => false 
                ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
                ))
            ->add('musicsPlaylists', 'sonata_type_collection', array(
                'label' => 'Playlist',
                'by_reference' => false 
                ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
                )) 
        ;
    }  
}