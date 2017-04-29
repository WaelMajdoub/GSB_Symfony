<?php

namespace GSBBundle\Controller;

use GSBBundle\Entity;
use GSBBundle\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->render('GSBBundle:Principal:deconnexion.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/accueil")
     */
    public function accueilAction()
    {
        return $this->render('GSBBundle:Principal:accueil.html.twig', array(// ...
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
     * @Route("/saisieFrais",name="saisieFrais")
     */
    public function saisieFraisAction(Request $request)
    {
        $date = date('Y') . date('m');

        $mois = 200101;

        $user = $this->getUser();
        $iduser = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $lesfraishf = $em->getRepository('GSBBundle:LigneFraisHorsForfait')->findBy(array('mois' => $mois, 'idUser' => $iduser));

        $em = $this->getDoctrine()->getManager();

        $etp = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => 'ETP')) ?: $lesfraisf['ETP'] = new Entity\Lignefraisforfait();
        $km = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => 'KM')) ?: $lesfraisf['KM'] = new Entity\Lignefraisforfait();
        $nui = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => 'NUI')) ?: $lesfraisf['NUI'] = new Entity\Lignefraisforfait();
        $rep = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => 'REP')) ?: $lesfraisf['REP'] = new Entity\Lignefraisforfait();

        $lesfraisf['ETP'] = $etp;
        $lesfraisf['KM'] = $km;
        $lesfraisf['NUI'] = $nui;
        $lesfraisf['REP'] = $rep;

        //Form nouveau frais forfait
        $formff = $this->createForm(Form\LigneFraisForfaitType::class, $lesfraisf);

        $formff->handleRequest($request);

        if ($formff->isSubmitted() && $formff->isValid()) {

            $data = $formff->getData();

            $etp->setQuantite($data['etape']);
            $etp->setIdUser($user);
            $etp->setMois($mois);
            $etp->setFraisForfait($em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'ETP')));

            $km->setQuantite($data['kilometre']);
            $km->setIdUser($user);
            $km->setMois($mois);
            $km->setFraisForfait($em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'KM')));

            $nui->setQuantite($data['hotel']);
            $nui->setIdUser($user);
            $nui->setMois($mois);
            $nui->setFraisForfait($em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'NUI')));

            $rep->setQuantite($data['restaurant']);
            $rep->setIdUser($user);
            $rep->setMois($mois);
            $rep->setFraisForfait($em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'REP')));


            $em->persist($etp);
            $em->persist($km);
            $em->persist($nui);
            $em->persist($rep);

            $em->flush();

        }

        //Form nouveau frais hors forfait
        $newfraishf = new Entity\LigneFraisHorsForfait();
        $formfhf = $this->createForm(Form\LigneFraisHorsForfaitType::class, $newfraishf);

        $formfhf->handleRequest($request);

        if ($formfhf->isSubmitted() && $formfhf->isValid()) {
            $data = $formfhf->getData();

            $newfraishf->setLibelle($data->getLibelle());
            $newfraishf->setMois($mois);
            $newfraishf->setDate($data->getDate());
            $newfraishf->setIdUser($user);
            //$newfraishf->setIdFicheFrais(); NULL dans la BD

            $em->persist($newfraishf);
            $em->flush();
        }

        return $this->render('GSBBundle:Principal:saisie_frais.html.twig', array(
            'mois' => $mois,
            'lesfraishf' => $lesfraishf,
            'formfhf' => $formfhf->createView(),
            'formff' => $formff->createView()
        ));
    }

    /**
     * @Route("/deleteHorsForfait/{id}", name="deleteLigneHorsForfait", requirements={"id": "\d+"})
     */
    public function deleteLigneHorsForfaitAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $lefraishf = $em->getRepository('GSBBundle:LigneFraisHorsForfait')->findBy(array('id' => $id));

        $em->remove($lefraishf[0]);
        $em->flush();

        return $this->redirectToRoute('saisieFrais');
    }


    /**
     * @Route("/etatFrais/select", name="etatFraisMoisSelectionne", options={"expose"=true})
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function selectMoisAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'Use only ajax please!'), 400);
        }

        $idUser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $anneesMois = $em->getRepository('GSBBundle:FicheFrais')->getLesMoisDisponibles($idUser);


        $em = $this->getDoctrine()->getManager();
        $meh = $em->getRepository('GSBBundle:FicheFrais')->getLesInfosFicheFrais($idUser, '200109');


        $lanneemoi = $request->get($anneesMois);

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->renderView('@GSB/Principal/etat_frais.html.twig',
                    array(
                        'anneesMois' => $anneesMois,
                        'meh' => $meh,
                        'lanneemoi' => $lanneemoi
                    ))), 400);


        return $response;

    }

}
