<?php

namespace GSBBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PrincipalController extends Controller
{
    /**
     * @Route("/connexion")
     */
    public function connexionAction()
    {
        return $this->render('GSBBundle:Principal:connexion.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deconnexion")
     */
    public function deconnexionAction()
    {
        return $this->render('GSBBundle:Principal:deconnexion.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/accueil")
     */
    public function accueilAction()
    {
        return $this->render('GSBBundle:Principal:accueil.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/gererFrais")
     */
    public function gererFraisAction()
    {
        return $this->render('GSBBundle:Principal:gerer_frais.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/etatFrais")
     */
    public function etatFraisAction()
    {
        return $this->render('GSBBundle:Principal:etat_frais.html.twig', array(
            // ...
        ));
    }

}
