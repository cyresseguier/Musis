<?php

namespace Team\MusisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MusicType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('album')
            ->add('year')
            ->add('link')
            ->add('places')
            ->add('artists')
            ->add('playlists')
            ->add('description')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Team\MusisBundle\Entity\Music'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'team_musisbundle_music';
    }
}
