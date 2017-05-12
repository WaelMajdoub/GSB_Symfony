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
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('idEtatFrais', EtatFraisType::class, array(
                'label' => 'Etat du frais',
                'attr' => array(
                    'class' => 'form-control'
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