<?php

namespace GSBBundle\Controller;

use GSBBundle\Form\FicheFraisType;
use GSBBundle\Entity\LigneFraisHorsForfait;
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


        return $this->render('@GSB/Principal/valid_Frais.html.twig',
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

        return new JsonResponse(array('ficheFrais' => $ficheFrais,
                                    'ligneFraisForfait' => $ligneFraisForfait,
                                    'ligneFraisHorsForfait' => $ligneFraisHorsForfait));



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


    /**
     * Méthode ajax qui va récupérer la fiche selectionnée et la valider
     * @Route("/validFrais/validerFiche!Ajax", name="validerFiche")
     * @param Request $request
     * @return mixed
     */
    public function validFicheAction(Request $request){

        // Recherche de l'état Valider
        $etat = $this->getDoctrine()->getRepository('GSBBundle:Etat')->findOneById('VA');

        // set de l'état valider à la fiche chargée
        $em = $this->getDoctrine()->getManager();
        $laFiche = $em->getRepository('GSBBundle:FicheFrais')->find($request->get('idFicheFrais'));
        $laFiche->setIdEtat($etat);
        $laFiche->setDateModif(new \DateTime('now'));

        $em->persist($laFiche);
        $em->flush();

        return new JsonResponse(array('laFiche' => $laFiche));

}




    /**
     * Route principale pour suivre les frais
     * @Route("/suivreFrais", name="suivreFrais")
     */
    public function suivreFraisAction()
    {
        // On retourne les visiteurs
        $lesVisiteurs = $this->getDoctrine()->getRepository('UserBundle:User')
            ->findByRole('ROLE_VISITEUR');


        return $this->render('@GSB/Principal/suivie_fiche.html.twig', array('visiteurs' => $lesVisiteurs));
    }


    /**
     * Méthode Ajax qui va permettre de remplir les mois disponible en fonction du visiteur selectionné et
     * des fiches Validees et mises en paiement
     * @Route("/validFrais/moisDispoParVisiteurFichesValides!Ajax", name="moisDispoParVisiteurFichesValides")
     * @param Request $request
     * @return mixed
     */
    public function moisDisponiblesFichesValidesAction(Request $request){
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access to this url with ajax only'), 400);
        }

        $repoFichefrais = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais');
        $dateManager = $this->get('gsb.date_manager');

        $dateTimeMoisDisponible = [];
        foreach ($repoFichefrais->getLesMoisDisponiblesDesFichesValidees($request->get('id')) as $key => $mois) {
            $dateTimeNow = $dateManager->YYYYMMToDateTime($mois['mois']);
            $dateTimeMoisDisponible[$key] = ['value' => $mois['mois'],
                'text' => $dateTimeNow->format('m/Y')];
        }

        return new JsonResponse(array('datesValides' => $dateTimeMoisDisponible));

    }



    /**
     * Méthode ajax qui va récupérer la fiche selectionnée et la mettre en paiement
     * @Route("/validFrais/mettreFicheEnPaiement!Ajax", name="mettreFicheEnPaiement")
     * @param Request $request
     * @return mixed
     */
    public function mettreFicheEnPaiementAction(Request $request){

        // Recherche de l'état Valider
        $etat = $this->getDoctrine()->getRepository('GSBBundle:Etat')->findOneById('MP');

        // set de l'état valider à la fiche chargée
        $em = $this->getDoctrine()->getManager();
        $laFiche = $em->getRepository('GSBBundle:FicheFrais')->find($request->get('idFicheFrais'));
        $laFiche->setIdEtat($etat);
        $laFiche->setDateModif(new \DateTime('now'));

        $em->persist($laFiche);
        $em->flush();

        return new JsonResponse(array('laFiche' => $laFiche));

    }

    /**
     *
     * @Route("/updateFHF", name="updateFHF")
     */
    public function updateFHFAction(){

        $etat = $this->getDoctrine()->getRepository('GSBBundle:EtatFrais')->findOneById('E');

        $me = $this->getDoctrine()->getManager();
        $fhf = $me->getRepository('GSBBundle:LigneFraisHorsForfait')->findAll();

        foreach ($fhf as $f) {

            $f->setIdEtatFrais($etat);
            $me->persist($f);
        }
        $me->flush();

        return $this->render('@FOSUser/done.html.twig');

    }

}
