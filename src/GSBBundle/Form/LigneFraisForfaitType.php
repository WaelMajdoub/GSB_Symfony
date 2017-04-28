<?php

namespace GSBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class LigneFraisForfaitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etape', IntegerType::class, array(
                'label' => 'Forfait Etape',
                'data' => ($options['data']['ETP']->getQuantite() !== null) ? $options['data']['ETP']->getQuantite() : 0,
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('kilometre', IntegerType::class, array(
                'label' => 'Forfait Kilometrique',
                'data' => ($options['data']['KM']->getQuantite() !== null) ? $options['data']['KM']->getQuantite() : 0,
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('hotel', IntegerType::class, array(
                'label' => 'Forfait Hotel',
                'data' => ($options['data']['NUI']->getQuantite() !== null) ? $options['data']['NUI']->getQuantite() : 0,
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('restaurant', IntegerType::class, array(
                'label' => 'Forfait Restaurant',
                'data' => ($options['data']['REP']->getQuantite() !== null) ? $options['data']['REP']->getQuantite() : 0,
                'attr' => array(
                    'class' => 'form-control'
                ),
                'translation_domain' => false
            ))
            ->add('ajouter', SubmitType::class, array(
                'label' => 'Ajouter frais forfait',
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
        return 'gsbbundle_lignefraisforfait';
    }


}