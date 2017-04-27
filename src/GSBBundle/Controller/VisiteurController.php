<?php

namespace GSBBundle\Controller;

use GSBBundle\Form\FicheFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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


        // Recupération de la ficheFrais
        $em = $this->getDoctrine()->getManager();
        $ficheFrais = $em->getRepository('GSBBundle:FicheFrais')->getLesInfosFicheFrais($idUser, '200110');


        // Recuperation des éléments forfaitisés



        return $this->render('@GSB/Principal/etat_frais.html.twig', array(
            'anneesMois' => $anneesMois,
            'ficheFrais' => $ficheFrais));
    }

}
