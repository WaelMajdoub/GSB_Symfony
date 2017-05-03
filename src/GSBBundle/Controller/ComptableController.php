<?php

namespace GSBBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ComptableController extends Controller
{

    /**
     * @Route("/validFrais")
     */
    public function validFraisAction()
    {
        // Recupération des Visiteurs

        $usersVisiteurs = $this->getDoctrine()->getRepository('UserBundle:User')
            ->findByRole('ROLE_VISITEUR');

        // TODO : faire en sorte que l'id serve à choisir le mois depuis la view et avec une route {id}
        //$mois = $this->getDoctrine()->getRepository('GSBBundle:FicheFrais')->getLesMoisDisponibles();

        $mois = $this->getDoctrine()->getRepository('GSBBundle:FicheFrais')->getLesMoisDisponibles(1);


        // TODO: Faire Un bouton pour valider un formulaire
        // TODO: Recup de ce qu'on envoit et éviter de tout faire en dur comme des b***s
        // Recherche de Ligne Frais Forfait par utilisateur + et par date selectionnée
        $lesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:FraisForfait')
            ->findAll();

        $lignesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:Lignefraisforfait')
            ->getLesFraisForfait(1, '200101');

        // Recherche de Ligne Frais Hors Forfait par utilisateur + et par date selectionnée
        $lignesFraisHorsForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraishorsforfait')
            ->getLesFraisHorsForfait(1, '200101');



        return $this->render('GSBBundle:Principal:valid_frais.html.twig', array('visiteurs' => $usersVisiteurs, 'mois' =>$mois, 'lff' => $lignesFraisForfait, 'fraisForfait' => $lesFraisForfait));
    }

    /**
     * @Route("/consultFrais")
     */
    public function consultFraisAction()
    {
        return $this->render('GSBBundle:Principal:consult_frais.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/gererFrais")
     */
    public function gererFraisAction()
    {
        return $this->render('GSBBundle:Principal:gerer_frais.html.twig', array(// ...
        ));
    }

}
