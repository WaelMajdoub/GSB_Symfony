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
        return $this->render('GSBBundle:Principal:valid_frais.html.twig', array(// ...
        ));
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
