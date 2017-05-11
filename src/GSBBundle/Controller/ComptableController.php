<?php

namespace GSBBundle\Controller;

use GSBBundle\Form\FicheFraisType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ComptableController extends Controller
{

    /**
     * Route principale de validation d'une fiche de Frais,
     * Elle recupère principalement la liste des visiteurs et fait des appels ajax pour récupérer les mois disponibles
     * En fonction du visteur sélectionné, Les elements forfaitisés et hors forfait correspondant à la fiche en question.
     * @Route("/validFrais",name="validFrais")
     */
    public function validFraisAction(Request $request)
    {

        // Recupération des Visiteurs

        $lesVisiteurs = $this->getDoctrine()->getRepository('UserBundle:User')
            ->findByRole('ROLE_VISITEUR');

        $formValider = $this->createForm(FicheFraisType::class);
        $formValider->handleRequest($request);

        if ($formValider->isSubmitted()) {
            if ($formValider->isValid()) {

                $em = $this->getDoctrine()->getRepository('GSBBundle:FicheFrais');
                $fiche = $em->findOneBy((array('id' => $request->get('idFicheFrais'),
                    'mois' => $request->get('mois'))));
                $fiche->setIdEtat('AZE');
                $em->persist($fiche);
                $em->flush();


                dump($fiche);
            }
        }


        return $this->render('GSBBundle:Principal:valid_frais.html.twig',
            array('visiteurs' => $lesVisiteurs, 'formBtn' =>$formValider->createView()
            ));
    }


    /**
     * Méthode Ajax qui va permettre de remplir les mois disponible en fonction du visiteur selectionné
     * @Route("/validFrais/moisDispoParVisiteur!Ajax", name="moisDispoParVisiteur")
     * @param Request $request
     * @return mixed
     */
    public function moisDispoParVisiteurAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_COMPTABLE', null, 'STAHP Access denied!');

        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access to this url with ajax only'), 400);
        }

        $repoFichefrais = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais');
        $dateManager = $this->get('gsb.date_manager');

        $dateTimeMoisDisponible = [];
        foreach ($repoFichefrais->getLesMoisDisponibles($request->get('id')) as $key => $mois) {
            $dateTimeNow = $dateManager->YYYYMMToDateTime($mois['mois']);
            $dateTimeMoisDisponible[$key] = ['value' => $mois['mois'],
                'text' => $dateTimeNow->format('m/Y')];
        }

        return new JsonResponse(array('dates' => $dateTimeMoisDisponible));

    }
    /**
     * Méthode ajax qui va ramener la ficheFrais d'après un ID Utilisateur recupéré en Ajax et
     * et le mois en sélectionné pour afficher les éléments forfaitisés et Hors Forfaits
     * @Route("/validFrais/getFiches!Ajax", name="getFiches")
     * @param Request $request
     * @return mixed
     */
    public function getFichesAction(Request $request)
    {

        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access to this url with ajax only'), 400);
        }
        $ficheFrais = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais')
            ->getLesInfosFicheFrais($request->get('id'), $request->get('mois'));
        $ligneFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisForfait')
            ->getLesFraisForfait($request->get('id'), $request->get('mois'));
        $ligneFraisHorsForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraisHorsForfait')
            ->getLesFraisHorsForfait($request->get('id'), $request->get('mois'));

        dump($ficheFrais);
        return new JsonResponse(array('ficheFrais' => $ficheFrais,
                                    'ligneFraisForfait' => $ligneFraisForfait,
                                    'ligneFraisHorsForfait' => $ligneFraisHorsForfait));



    }


    /**
     * Route principale de consultation des Frais
     * @Route("/consultFrais", name="consultFrais")
     */
    public function consultFraisAction()
    {
        return $this->render('GSBBundle:Principal:consult_frais.html.twig', array(// ...
        ));
    }

    /**
     * Route principale de gestion de Frais
     * @Route("/gererFrais")
     */
    public function gererFraisAction()
    {
        return $this->render('GSBBundle:Principal:gerer_frais.html.twig', array(// ...
        ));
    }

}
