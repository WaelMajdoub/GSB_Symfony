<?php

namespace GSBBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use GSBBundle\Form\FicheFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class VisiteurController extends Controller
{
    /**
     * @Route("/etatFrais")
     */
    public function etatFraisAction()
    {

        $idUser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $anneesMois = $em->getRepository('GSBBundle:FicheFrais')->getLesMoisDisponibles($idUser);
        $lesLignesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisForfait')->getLesFraisForfait($idUser, '200108');
        $lesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:FraisForfait')->findAll();
        $lesLignesFraisHorsForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisHorsForfait')->getLesFraisHorsForfait($idUser, '200108');

        $nbJustificatifs = $this->getDoctrine()->getRepository('GSBBundle:FicheFrais')->getNbjustificatifs($idUser, '200108');


        /*
        $formMois = $this->createFormBuilder()
            ->add('date', ChoiceType::class, array(
                'choices' => $anneesMois,
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
                ))
            ->getForm();
*/

        
        // Recupération de la ficheFrais
        $em = $this->getDoctrine()->getManager();
        $ficheFrais = $em->getRepository('GSBBundle:FicheFrais')->getLesInfosFicheFrais($idUser, '200108');



        // Recuperation des éléments forfaitisés


        return $this->render('@GSB/Principal/etat_frais.html.twig', array(
            'anneesMois' => $anneesMois,
            'ficheFrais' => $ficheFrais,
            'lignesFraisForfait' => $lesLignesFraisForfait,
            'lesFraisForfait' => $lesFraisForfait,
            'lignesFraisHorsForfait' => $lesLignesFraisHorsForfait,
            'nbJustificatifs' => $nbJustificatifs
));
    }

}
