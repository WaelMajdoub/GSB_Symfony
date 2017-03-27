<?php
namespace GSBBundle\Controller;

use GSBBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


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
     * @Route("/meh")
     */
    public function mehAction()
    {
        return $this->render('GSBBundle:Principal:meh.html.twig', array(
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
    /**
     * test le fait d'ajouter un objet en BDD sous doctrine
     * @Route("/newMeh")
     */
    public function createAction()
    {

        // Création de l'objet
        $me = new Entity\FraisForfait();
        $me->setId("A123");
        $me->setLibelle("OH OUI");
        $me->setMontant(125.12);


        $em = $this->getDoctrine()->getManager();
        $em->persist($me);
        // ne pas oublier le >
        $em->flush();


        // SI tout se passe bien on renvoie ( il y a un E, merci Huho) la vue spéciale
    return $this->render('GSBBundle:Principal:meh.html.twig', array(
        // ...
    ));

}
    /**
     * test le fait d'ajouter un objet en BDD sous doctrine
     * @Route("/newUser")
     */
    public function createUserAction(){

        $user = new Entity\Visiteur("HUGOBB","meh","meh@meh.fr");


        $tamere = $this->getDoctrine()->getManager();
        $tamere->persist($user);
        // ne pas oublier le >
        $tamere->flush();


        return $this->render('GSBBundle:Principal:user.html.twig', array(
            // ...
        ));
    }
    /**
     * test le fait d'ajouter un objet en BDD sous doctrine
     * @Route("/stp")
     */
    public function getAllUsers(){

        $visiteur = $this->getDoctrine()->getRepository('GSBBundle:Visiteur');

        $mehs = $visiteur->findAll();
        dump($mehs);

        return $this->render('GSBBundle:Principal:connexion.html.twig', array('mesFesses' => $mehs));

    }

    /**
     * @Route("/etat")
     */
        public function getEtats(){


        $etat = $this->getDoctrine()->getRepository('GSBBundle:Etat');
        $mehs = $etat->findAll();
        dump($mehs);
            return $this->render('GSBBundle:Principal:connexion.html.twig', array('mesFesses' => $mehs));


        }

}
