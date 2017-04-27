<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/connexion")
     */
    public function indexAction()
    {

    }

    /**
     * Quelques tests de queries
     * @Route("/test", name="test")
     */
    public function testAction(){

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $infosUser = $em->getRepository('UserBundle:User')->getInfosVisiteurs($user->getUsername(), $user->getPassword());

        $em = $this->getDoctrine()->getManager();
        $infolignesfraishorsforfait = $em->getRepository('GSBBundle:LigneFraisHorsForfait')->getLesFraisHorsForfait($user, 200101);

        return $this->render('@User/test.html.twig', array(
            'infosUser' => $infosUser,
            'leslignesfraishorsforfait' => $infolignesfraishorsforfait));
    }
}
