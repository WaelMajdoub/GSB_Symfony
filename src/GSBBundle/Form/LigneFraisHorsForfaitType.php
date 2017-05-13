<?php

namespace GSBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LigneFraisHorsForfaitType
 * @package GSBBundle\Form
 */
class LigneFraisHorsForfaitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
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
            ));

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gsbbundle_lignefraishorsforfait';
    }


}