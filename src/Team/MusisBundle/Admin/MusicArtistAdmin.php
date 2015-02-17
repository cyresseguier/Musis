<?php
 
namespace Team\MusisBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
 
class MusicArtistAdmin extends Admin
{

	protected function configureFormFields(FormMapper $formMapper)
    {
    $formMapper
    ->add('artist', 'sonata_type_model_list', array(
    "label" => "Linked Artist",
    "btn_add" => true
    ), array(
    ))
    ->end();
    }
}