<?php

namespace GSBBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ComptableController extends Controller
{

    /**
     * @Route("/validFrais")
     */
    public function validFraisAction()
    {
        // Recupération des Visiteurs

        $lesVisiteurs = $this->getDoctrine()->getRepository('UserBundle:User')
            ->findByRole('ROLE_VISITEUR');


        return $this->render('GSBBundle:Principal:valid_frais.html.twig',
            array('visiteurs' => $lesVisiteurs,
            ));
    }


    /**
     * Méthode Ajax qui va permettre de remplir les mois disponible en fonction du visiteur selectionné
     * @Route("/validFrais/moisDispoParVisiteur!Ajax", name="moisDispoParVisiteur")
     * @param Request $request
     * @return meh
     */
    public function moisDispoParVisiteurAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access to this url with ajax only'), 400);
        }
        $moisDispo = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais')->getLesMoisDisponibles($request->get('id'));

        return new JsonResponse(array('dates' => $moisDispo));
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
