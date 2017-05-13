<?php

namespace GSBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FraisForfaitType
 * @package GSBBundle\Form
 */
class FraisForfaitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id')->add('libelle')->add('montant');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GSBBundle\Entity\FraisForfait'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gsbbundle_fraisforfait';
    }


}
