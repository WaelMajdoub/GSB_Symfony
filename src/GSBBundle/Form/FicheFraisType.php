<?php

namespace GSBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FicheFraisType
 * @package GSBBundle\Form
 */
class FicheFraisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mois')->add('nbJustificatifs')->add('montantValide')->add('dateModif')->add('idUser');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GSBBundle\Entity\FicheFrais'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gsbbundle_fichefrais';
    }


}
