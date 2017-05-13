<?php

namespace GSBBundle\Controller;

use GSBBundle\Form\ListeMois;
use GSBBundle\Form\MoisType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class VisiteurController qui regroupe toutes les actions réservées aux visiteurs
 * @package GSBBundle\Controller
 */
class VisiteurController extends Controller
{
    /**
     * Action qui permet de générer la view etatFrais
     * @Route("/etatFrais", name="etatFrais")
     */
    public function etatFraisAction(Request $request)
    {
        // id de l'utilisateur courant
        $idUser = $this->getUser()->getId();

        $roles = $this->getUser()->getRoles();

        $ficheFraisRepository = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais');
        // Appel d'un service créé dans le bût de gérer les dates mal foutues ( merci Thomas @Sevenn)
        $dateManager = $this->get('gsb.date_manager');

        // GESTION DES MOIS //
        $moisDisponibles = $ficheFraisRepository->getLesMoisDisponibles($idUser);
        $listeMoisDisponibles = [];


        foreach ($moisDisponibles as $mois) {
            $dateTime = $dateManager->YYYYMMToDateTime($mois['mois']);
            $listeMoisDisponibles[$dateTime->format('m/Y')] = $mois['mois'];
        }


        $formMois = $this->createForm(MoisType::class, array('data_form' => $listeMoisDisponibles));
        $formMois->handleRequest($request);


        $tableauEtatFrais = [];
        $dateSelectionnee = 200101;
        if ($formMois->isSubmitted()) {
            if ($formMois->isValid()) {
                // Récupération de la date envoyée dans le form
                $dateSelectionnee = $formMois->getData()['date'];


                $tableauEtatFrais['dateSelectionnee'] = $this->get('gsb.date_manager')->YYYYMMToDateTime($dateSelectionnee);
                // QUERY + AJOUT DANS LE TABLEAU //
                $fraisForfait = $this->getDoctrine()->getRepository('GSBBundle:FraisForfait')
                    ->findAll();
                $tableauEtatFrais['fraisForfait'] = $fraisForfait;
                // QUERY + AJOUT DANS LE TABLEAU //
                $ficheFrais = $this->getDoctrine()->getRepository('GSBBundle:Fichefrais')
                    ->getLesInfosFicheFraisObject($this->getUser()->getId(), $dateSelectionnee);
                $tableauEtatFrais['infoFicheFrais'] = $ficheFrais;
                // QUERY + AJOUT DANS LE TABLEAU //
                $lignesFraisForfait = $this->getDoctrine()->getRepository('GSBBundle:Lignefraisforfait')
                    ->getLesFraisForfait($this->getUser()->getId(), $dateSelectionnee);
                $tableauEtatFrais['lignesFraisForfait'] = $lignesFraisForfait;
                // QUERY + AJOUT DANS LE TABLEAU //
                $lignesFraisHorsForfait = $this->getDoctrine()->getRepository('GSBBundle:LigneFraishorsforfait')
                    ->getLesFraisHorsForfait($this->getUser()->getId(), $dateSelectionnee);
                $tableauEtatFrais['lignesFraisHorsForfait'] = $lignesFraisHorsForfait;
            }
        }
        return $this->render('@GSB/Principal/etat_frais.html.twig', array(
            'formMois' => $formMois->createView(),
            'infoEtatFrais' => $tableauEtatFrais,
            'roles' => $roles,
            'iduser' => $idUser,
            'mois' => $dateSelectionnee
        ));
    }

    /**
     * Action qui permet de gérer le PDF
     * @Route("/etatFrais/pdf/{id}/{mois}")
     */
    public function pdfAction(Request $request)
    {
        // Modifier mois selectionné
        $mois = $request->get('mois');

        $iduser = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findOneBy(array('id' => $iduser));

        $etp = $em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'ETP'));
        $nui = $em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'NUI'));
        $km = $em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'KM'));
        $rep = $em->getRepository('GSBBundle:FraisForfait')->findOneBy(array('id' => 'REP'));

        $fetp = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => $etp));
        $fnui = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => $nui));
        $fkm = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => $km));
        $frep = $em->getRepository('GSBBundle:LigneFraisForfait')->findOneBy(array('mois' => $mois,
            'idUser' => $iduser, 'idFraisForfait' => $rep));

        $lesfhf = $em->getRepository('GSBBundle:LigneFraisHorsForfait')->findBy(array('mois' => $mois,
            'idUser' => $iduser));

        //Check si le PDF du mois existe déja
        $fs = new Filesystem();
        if (!$fs->exists('PDFs/' . $iduser . '-' . $mois . '.pdf')) {

            $this->get('knp_snappy.pdf')->generateFromHtml(
                $this->renderView(
                    'GSBBundle:Principal:pdf.html.twig', array('user' => $user, 'etp' => $etp, 'nui' => $nui, 'km' => $km, 'rep' => $rep,
                        'fetp' => $fetp, 'fnui' => $fnui, 'fkm' => $fkm, 'frep' => $frep, 'mois' => $mois, 'lesfhf' => $lesfhf)
                ),
                'PDFs/' . $iduser . '-' . $mois . '.pdf'
            );
        }

        $path = $this->get('kernel')->getRootDir(). "/../web/PDFs/";
        $content = file_get_contents($path.$iduser . '-' . $mois . '.pdf');

        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$iduser . '-' . $mois . '.pdf');

        $response->setContent($content);
        return $response;

    }


}

