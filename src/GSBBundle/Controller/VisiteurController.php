<?php

namespace GSBBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VisiteurController extends Controller
{
    /**
     * @Route("/etatFrais")
     */
    public function etatFraisAction(Request $request)
    {
        $idUser = $this->getUser()->getId();
        $dateTimeMoisDisponible = [];
        $em = $this->getDoctrine()->getManager();
        $anneesMois = $em->getRepository('GSBBundle:FicheFrais')->getLesMoisDisponibles($idUser);
        $lesLignesFraisHorsForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisHorsForfait')->getLesFraisHorsForfait($idUser, '200109');
        $nbJustificatifs = $this->getDoctrine()->getRepository('GSBBundle:FicheFrais')->getNbjustificatifs($idUser, '200109');
        $ficheFrais = $this->getDoctrine()->getRepository('GSBBundle:FicheFrais')->getLesInfosFicheFrais($idUser, '200109');
        $lesLignesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisForfait')->getLesFraisForfait($idUser, '200109');

        $lesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:FraisForfait')->findAll();

        foreach ($anneesMois as $mois) {
            array_push($dateTimeMoisDisponible, $mois['mois']);
        }

        $formMois = $this->createFormBuilder()
            ->add('date', ChoiceType::class, array(
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
            ))
            ->getForm();


        $formMois->handleRequest($request);

        if ($formMois->isSubmitted()) {
            if ($formMois->isValid()) {
                $moiSelected = $formMois->getData()['mois'];


                $lesLignesFraisHorsForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisHorsForfait')->getLesFraisHorsForfait($idUser, $moiSelected);
                $ficheFrais = $this->getDoctrine()->getRepository('GSBBundle:FicheFrais')->getLesInfosFicheFrais($idUser, $moiSelected);
                $lesLignesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisForfait')->getLesFraisForfait($idUser, $moiSelected);


                // TODO WIP : Gérer l'update automatique à chaque changement
            }
        }


        return $this->render('@GSB/Principal/etat_frais.html.twig', array(
            'anneesMois' => $dateTimeMoisDisponible,
            'ficheFrais' => $ficheFrais,
            'lignesFraisForfait' => $lesLignesFraisForfait,
            'lesFraisForfait' => $lesFraisForfait,
            'lignesFraisHorsForfait' => $lesLignesFraisHorsForfait,
            'nbJustificatifs' => $nbJustificatifs
        ));
    }

}
