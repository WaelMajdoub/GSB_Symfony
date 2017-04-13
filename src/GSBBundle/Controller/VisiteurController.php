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
        $em = $this->getDoctrine()->getManager();
        $visiteurs = $this->get('fos_user.user_manager')->findUsers();


        return $this->render('GSBBundle:Principal:meh.html.twig', array(
            'visiteurs' => $visiteurs,
            ));
    }
}
