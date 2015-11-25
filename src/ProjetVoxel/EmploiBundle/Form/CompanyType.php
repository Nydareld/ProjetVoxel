<?php

namespace ProjetVoxel\EmploiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', 'text', array(
                'label' => 'Nom de l\'entreprise:',
                'attr' => array('class' =>'form-control')))
            ->add('activity', 'text', array(
                'label' => 'Activité de l\'entreprise:',
                'attr' => array('class' =>'form-control')))
            ->add('description', 'textarea', array(
                'label' => 'Déscription de l\'entreprise:',
                'attr' => array('class' =>'form-control TA100')))
            ->add('file')
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
            'data_class' => 'ProjetVoxel\EmploiBundle\Entity\Company'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projetvoxel_emploibundle_company';
    }
}
