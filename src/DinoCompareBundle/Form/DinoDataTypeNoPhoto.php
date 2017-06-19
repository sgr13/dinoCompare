<?php

namespace DinoCompareBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DinoDataTypeNoPhoto extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nazwa:'))
            ->add('weight', 'text', array('label' => 'Waga:'))
            ->add('lenght', 'text', array('label' => 'Długość:'))
            ->add('height', 'text', array('label' => 'Wysokość:'))
            ->add('discoverYear', 'text', array('label' => 'Odkryty w:'))
            ->add('foodtype', EntityType::class, array(
                'class' => 'DinoCompareBundle:FoodType',
                'choice_label' => 'name', 'label' => 'Typ:'))
            ->add('period', EntityType::class, array(
                'class' => 'DinoCompareBundle:Period',
                'choice_label' => 'name','label' => 'Okres:'))
            ->add('dinoOrder', EntityType::class, array(
                'class' => 'DinoCompareBundle:DinoOrder',
                'choice_label' => 'name', 'label' => 'Rząd:'))
            ->add('dinoSuborder', EntityType::class, array(
                'class' => 'DinoCompareBundle:DinoSuborder',
                'choice_label' => 'name', 'label' => 'Podrząd:'))
            ->add('save', 'submit', array('label' => 'Zapisz'))
            ;
    }

    public function getName()
    {
        return '';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DinoCompareBundle\Entity\DinoData'
        ));
    }
}

//