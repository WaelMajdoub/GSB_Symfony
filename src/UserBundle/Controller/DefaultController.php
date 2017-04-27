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

        $em1 = $this->getDoctrine()->getManager();
        $infosUser = $em1->getRepository('UserBundle:User')->getInfosVisiteurs($user->getUsername(), $user->getPassword());

        $em2 = $this->getDoctrine()->getManager();
        $infolignesfraishorsforfait = $em2->getRepository('GSBBundle:LigneFraisHorsForfait')->getLesFraisHorsForfait($user, 200101);


        $em3 = $this->getDoctrine()->getManager();
        $nbJustificatif = $em3->getRepository('GSBBundle:FicheFrais')->getNbjustificatifs($user->getId(), 200101);


        return $this->render('@User/test.html.twig', array(
            'infosUser' => $infosUser,
            'leslignesfraishorsforfait' => $infolignesfraishorsforfait,
            'nbJustificatif' => $nbJustificatif));

    }
}
