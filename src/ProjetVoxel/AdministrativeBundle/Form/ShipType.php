<?php

namespace ProjetVoxel\AdministrativeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ShipType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('name', 'text', array(
                'label' => 'Nom du vaisseau'))
            ->add('crewSize', 'text', array('label' => 'Classe du vaisseau'))
            ->add('isLarge','checkbox',array('label' => 'petit vaisseau' ))
            ->add('category','text',array('label' => 'Catégorie du vaisseau'))
            ->add('isWeaponed','checkbox',array('label' => 'Ce vaisseau est armé'))
            ->add('isLanding','checkbox',array('label' => 'Ce vaisseau peut aterrir sur une planète'))
            ->add('isToolEquiped','checkbox',array('label' => 'Ce vaisseau est équipé d\'outils'))
            ->add('jumpDrive','checkbox',array('label' => 'Ce vaisseau est équipé d\'un jump drive'))
            ->add('standardDocking','checkbox',array('label' => 'Ce vaisseau est équipé d\'un système d\'amarrage standarisé'))
            ->add('owner','choice')
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjetVoxel\AdministrativeBundle\Entity\Ship'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projetvoxel_administrativebundle_ship';
    }
}
