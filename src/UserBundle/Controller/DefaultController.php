<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/mehmehmeh")
     */
    public function indexAction()
    {

        dump($this->getDoctrine()->getRepository('UserBundle:User')->findMeh());

        return $this->render('UserBundle:Default:index.html.twig');
    }
}
