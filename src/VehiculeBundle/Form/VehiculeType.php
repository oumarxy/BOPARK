<?php

namespace VehiculeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VehiculeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('immatriculation')
            ->add('numeroCarteGrise')
            ->add('dateMiseEnCirculation', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy'))
            ->add('numeroChassis')
            ->add('poids')
            ->add('kilometrage')
            ->add('couleur')
            ->add('marque')
            ->add('categorie')
            ->add('place')
            ->add('path', FileType::class, array('required' => false))
            ->add('typeacquisition',ChoiceType::class,array('choices'=>array(
                'Achat'=>'Achat',
                'Location'=>'Location',
                'Leasing'=>'Leasing'
                ),
                'placeholder'=>'Mode d\'acquisition'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VehiculeBundle\Entity\Vehicule'
        ));
    }
}
