<?php

namespace VehiculeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UtilisationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vehicule')
            //->add('client')
            ->add('trajet', TrajetType::class)
            ->add('conducteur',null, array('placeholder'=>''))
            ->add('dateDebut', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy'))
            ->add('dateFin', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy'))
            ->add('dateFinReel', DateType::class, array(
                'required'=>false,
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy'))
            ->add('etat',ChoiceType::class,array('choices'=>array(
                'En attente'=>'En attente',
                'En cours'=>'En cours',
                'Terminé'=>'Terminé',
                'Annulé'=>'Annulé',
                )
            ))
            ->add('description')
            ->add('kilometrageArrivee')
            ->add('kilometrageDepart')
            ->add('etatCarburantDepart',ChoiceType::class,array('choices'=>array(
                'Bas'=>'Bas',
                'Moyen'=>'Moyen',
                'Elévé'=>'Elévé'
            ),
                'placeholder'=>'Départ'
            ))
            ->add('etatCarburantArrivee',ChoiceType::class,array('choices'=>array(
                'Bas'=>'Bas',
                'Moyen'=>'Moyen',
                'Elévé'=>'Elévé'
            )
            ))
            ->add('heureDebut',TimeType::class, array(
                'widget' => 'single_text', 'html5' => false))
            ->add('heureFin',TimeType::class, array(
                'widget' => 'single_text', 'html5' => false))
            ->add('heureFinReel',TimeType::class, array(
                'widget' => 'single_text', 'html5' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VehiculeBundle\Entity\Utilisation'
        ));
    }
}
