<?php

namespace ProjetVoxel\VentesBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogueItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Nom de l\'entrée catalogue:'))
            ->add('unitPrice', 'integer', array(
                'label' => 'Prix unitaire:'))
            ->add('quantity', 'integer', array(
                'label' => 'quantitée en stock:'))
            ->add('unit', 'text', array(
                'label' => 'Unitée ( si objet non dénombrable ex : ressource en Kg/L ):'))
            ->add('type', 'choice', array(
                'choices'  => array(
                    'Service' => "service",
                    'Objet (objet simple ou composé ex : fer, vaisseau ... )' => "item",
                    ),
                'label' => 'Type:',
                'choices_as_values' => true))
            ->add('save', 'submit', array(
                'label' => 'Sauvegarder',
                'attr' => array('class' =>'btn btn-default')))
            ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjetVoxel\VentesBundle\Entity\CatalogueItem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projetvoxel_ventesbundle_catalogueitem';
    }
}
