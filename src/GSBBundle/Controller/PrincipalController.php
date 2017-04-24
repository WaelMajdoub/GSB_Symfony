<?php
namespace GSBBundle\Controller;

use GSBBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class PrincipalController
 * @package GSBBundle\Controller
 */
class PrincipalController extends Controller
{
    /** Action principale qui sert d'index, à la racine du projet On va tester si l'utilisateur est connecté et dans ce cas
     * On le renvoit vers la page d'accueil, dans le cas contraire on le redirige vers la route /login qui va lui servir à
     * S'authentifier.
     * @Route("/")
     */
    public function indexAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->forward('FOSUserBundle:Security:login');

        } else {
            $user = $this->getUser();
            return $this->render('GSBBundle:Principal:accueil.html.twig', array('user', $user
            ));

        }
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

        $idUser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $anneesMois = $em->getRepository('GSBBundle:FicheFrais')->getLesMoisDisponibles($idUser);


        $em = $this->getDoctrine()->getManager();
        $meh = $em->getRepository('GSBBundle:FicheFrais')->getLesInfosFicheFrais($idUser, '200109');

        return $this->render('GSBBundle:Principal:etat_frais.html.twig', array(
            'anneesMois' => $anneesMois,
            'meh' => $meh,
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
     * @Route("/guigui")
     */
    public function guiguiAction()
    {
        $etatRepo = $this->getDoctrine()
            ->getRepository('GSBBundle:Etat');
        $etats = $etatRepo->findAll();

        return $this->render('GSBBundle:Principal:guigui.html.twig', array('etats' =>$etats
        ));
    }

}
