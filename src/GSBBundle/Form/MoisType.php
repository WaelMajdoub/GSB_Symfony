<?php

namespace GSBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class MoisType
 * @package GSBBundle\Form
 */
class MoisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dateTimeMoisDisponible = $options['data']['data_form'];

        $builder->add('date', ChoiceType::class, array(
            'choices' => $dateTimeMoisDisponible,
            'required' => true,
            'label' => 'Date : ',
            'attr' => array(
                'class' => 'form-control'
            )))
            ->add('ajouter', SubmitType::class, array(
                'label' => 'Valider',
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
}