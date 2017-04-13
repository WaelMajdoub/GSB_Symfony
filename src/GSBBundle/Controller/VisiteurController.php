<?php

namespace GSBBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VisiteurController extends Controller
{

    /**
     * @Route("/getvisiteurs")
     */
    public function visiteursAction()
    {

        $visiteurs = $this->getDoctrine()
            ->getRepository('GSBBundle:Visiteur')
            ->findAll();

        return $this->render('GSBBundle:Principal:meh.html.twig', array(
            'visiteurs' => $visiteurs,
            ));
    }




}
