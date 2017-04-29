<?php

namespace GSBBundle\Controller;

use GSBBundle\Form\ListeMois;
use GSBBundle\Form\MoisType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VisiteurController extends Controller
{
    /**
     * @Route("/etatFrais", name="etatFrais")
     */
    public function etatFraisAction(Request $request)
    {
        // id de l'utilisateur courant
        $idUser = $this->getUser()->getId();

        $ficheFraisRepository = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais');
        // Appel d'un service créé dans le bût de gérer les dates mal foutues ( merci Thomas @Sevenn)
        $dateManager = $this->get('gsb.date_manager');

        // GESTION DES MOIS //
        $moisDisponibles = $ficheFraisRepository->getLesMoisDisponibles($idUser);
        $listeMoisDisponibles = [];


        foreach ($moisDisponibles as $mois) {
            $dateTime = $dateManager->YYYYMMToDateTime($mois['mois']);
            $listeMoisDisponibles[$dateTime->format('m/Y')] = $mois['mois'];
        }


        $formMois = $this->createForm(MoisType::class, array('data_form' => $listeMoisDisponibles));
        $formMois->handleRequest($request);


        $tableauEtatFrais = [];
        if ($formMois->isSubmitted()) {
            if ($formMois->isValid()) {
                // Récupération de la date envoyée dans le form
                $dateSelectionnee = $formMois->getData()['date'];


                $tableauEtatFrais['dateSelectionnee'] = $this->get('gsb.date_manager')->YYYYMMToDateTime($dateSelectionnee);
                // QUERY + AJOUT DANS LE TABLEAU //
                $fraisForfait = $this->getDoctrine()->getRepository('GSBBundle:FraisForfait')
                    ->findAll();
                $tableauEtatFrais['fraisForfait'] = $fraisForfait;
                // QUERY + AJOUT DANS LE TABLEAU //
                $ficheFrais = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais')
                    ->getLesInfosFicheFrais($this->getUser()->getId(), $dateSelectionnee);
                $tableauEtatFrais['infoFicheFrais'] = $ficheFrais;
                // QUERY + AJOUT DANS LE TABLEAU //
                $lignesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:Lignefraisforfait')
                    ->getLesFraisForfait($this->getUser()->getId(), $dateSelectionnee);
                $tableauEtatFrais['lignesFraisForfait'] = $lignesFraisForfait;
                // QUERY + AJOUT DANS LE TABLEAU //
                $lignesFraisHorsForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraishorsforfait')
                    ->getLesFraisHorsForfait($this->getUser()->getId(), $dateSelectionnee);
                $tableauEtatFrais['lignesFraisHorsForfait'] = $lignesFraisHorsForfait;
            }
        }
        return $this->render('@GSB/Principal/etat_frais.html.twig', array(
            'formMois' => $formMois->createView(),
            'infoEtatFrais' => $tableauEtatFrais
        ));
    }

}

