<?php

namespace ProjetVoxel\VentesBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BasketItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', 'integer', array(
                'label' => 'quantitée a ajouter au panier ?'))
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
            'data_class' => 'ProjetVoxel\VentesBundle\Entity\BasketItem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projetvoxel_ventesbundle_basketitem';
    }
}
