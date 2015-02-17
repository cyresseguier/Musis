<?php
 
namespace Team\MusisBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
 
class MusicPlaceAdmin extends Admin
{

	protected function configureFormFields(FormMapper $formMapper)
    {
    $formMapper
    ->add('place', 'sonata_type_model_list', array(
    "label" => "Linked Place",
    "btn_add" => true
    ), array(
    ))
    ->end();
    }
}