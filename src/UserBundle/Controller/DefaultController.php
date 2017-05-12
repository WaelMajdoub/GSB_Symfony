<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Role\Role;

class DefaultController extends Controller
{
    /**
     * Quelques tests de queries
     * @Route("/test", name="test")
     */
    public function testAction(){
        $user = $this->getUser();
        $em2 = $this->getDoctrine()->getManager();
        $FicheFraisFindAll = $em2->getRepository('GSBBundle:FicheFrais')->findAll();
        $FicheFraisFindId1 = $em2->getRepository('GSBBundle:FicheFrais')->find(1);
        //$creerLigneFrais106 = $em2->getRepository('GSBBundle:FicheFrais')->creerNouvellesLignesFrais(1, 06);
        $dernierMoisSaisi = $em2->getRepository('GSBBundle:FicheFrais')->dernierMoisSaisi(27);
        $estPremierFraisMois = $em2->getRepository('GSBBundle:FicheFrais')->estPremierFraisMois(27, 201604);
        $infosFicheFrais = $em2->getRepository('GSBBundle:FicheFrais')->getLesInfosFicheFrais(27, 201604);
        $moisDisponibles = $em2->getRepository('GSBBundle:FicheFrais')->getLesMoisDisponibles(27);
        $nbJustificatifs = $em2->getRepository('GSBBundle:FicheFrais')->getNbjustificatifs(27, 201604);




        return $this->render('@User/test.html.twig', array(
            'FicheFraisFindAll' => $FicheFraisFindAll,
            'FicheFraisFindId1' => $FicheFraisFindId1,
            // 'creerLigneFrais106' => $creerLigneFrais106      GetEtat dans creerNouvellesLignesFrais impossible dans l'array
            'dernierMoisSaisi' => $dernierMoisSaisi, //TODO : vérifier l'id du visiteur car il ne semble pas correspondre à celui passé en param
            'estPremierFraisMois' => $estPremierFraisMois,
            'infosFicheFrais' => $infosFicheFrais, //TODO : No result was found for query although at least one row was expected.
            'moisDisponibles' => $moisDisponibles, //TODO : No result was found for query although at least one row was expected.
            'nbJustificatifs' => $nbJustificatifs
          ));

    }

    /**
     * @Route("/updateusers", name="updateusers")
     */
    public function updateAction(){

        $userRepo = $this->getDoctrine()->getManager();
        $allUsers = $userRepo->getRepository('UserBundle:User')->findAll();
        foreach ($allUsers as $user){
            $user->setRoles(array('ROLE_VISITEUR'));
            $userRepo->persist($user);
        }
        $userRepo->flush();
        return $this->render('@FOSUser/done.html.twig', array('users' => $allUsers));

    }


}
