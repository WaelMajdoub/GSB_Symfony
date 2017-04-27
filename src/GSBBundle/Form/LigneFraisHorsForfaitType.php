<?php

namespace GSBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class LigneFraisHorsForfaitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'label' => 'Date',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('libelle', TextType::class, array(
                'label' => 'Libelle',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('montant', IntegerType::class, array(
                'label' => 'Montant',
                'data'=>0,
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('ajouter', SubmitType::class, array(
                'label' => 'Ajouter frais hors forfait',
                'attr' => array(
                    'class' => 'btn btn-success'
                ),
                'translation_domain' => false
            ))
            ->add('effacer', ResetType::class, array(
                'label' => 'Effacer',
                'attr' => array(
                    'class' => 'btn btn-danger'
                ),
                'translation_domain' => false
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gsbbundle_lignefraishorsforfait';
    }


}