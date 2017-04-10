<?php
namespace GSBBundle\Controller;

use GSBBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Compiler\ResolveDefinitionTemplatesPass;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


class PrincipalController extends Controller
{


    /**
     * @Route("/")
     */
    public function indexAction()
    {
        // Si l'utilisateur n'est pas connecté, on le renvoie vers la page de login
        if (!$this->getUser()) {
            return $this->redirect('login');

        } else {
            return $this->render('GSBBundle:Principal:accueil.html.twig', array(// ...
            ));

        }
    }

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

    /**
     * @Route("/validFrais")
     */
    public function validFraisAction()
    {
        return $this->render('GSBBundle:Principal:valid_frais.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/consultFrais")
     */
    public function consultFraisAction()
    {
        return $this->render('GSBBundle:Principal:consult_frais.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/saisieFrais")
     */
    public function saisieFraisAction()
    {
        return $this->render('GSBBundle:Principal:saisie_frais.html.twig', array(
            // ...
        ));
    }


}
