<?php

namespace GSBBundle\Controller;

use GSBBundle\Entity\Etat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controlleur du Crud Etat réservé au super admin qui permet d'avoir les interfaces de gestions des Etats
 * @Security("has_role('ROLE_SUPER_ADMIN')")
 * @Route("etat")
 */
class EtatController extends Controller
{
    /**
     * Recupère tous les Etats
     *
     * @Route("/", name="etat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etats = $em->getRepository('GSBBundle:Etat')->findAll();

        return $this->render('etat/index.html.twig', array(
            'etats' => $etats,
        ));
    }

    /**
     * Crée un nouvel Etat
     *
     * @Route("/new", name="etat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $etat = new Etat();
        $form = $this->createForm('GSBBundle\Form\EtatType', $etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etat);
            $em->flush();

            return $this->redirectToRoute('etat_show', array('id' => $etat->getId()));
        }

        return $this->render('etat/new.html.twig', array(
            'etat' => $etat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Recherche et Affiche l'état choisi
     *
     * @Route("/{id}", name="etat_show")
     * @Method("GET")
     */
    public function showAction(Etat $etat)
    {
        $deleteForm = $this->createDeleteForm($etat);

        return $this->render('etat/show.html.twig', array(
            'etat' => $etat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Rend un formulaire pour éditer un état particulier
     *
     * @Route("/{id}/edit", name="etat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Etat $etat)
    {
        $deleteForm = $this->createDeleteForm($etat);
        $editForm = $this->createForm('GSBBundle\Form\EtatType', $etat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etat_edit', array('id' => $etat->getId()));
        }

        return $this->render('etat/edit.html.twig', array(
            'etat' => $etat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Supprime un Objet de Type Etat de la base de données
     *
     * @Route("/{id}", name="etat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Etat $etat)
    {
        $form = $this->createDeleteForm($etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etat);
            $em->flush();
        }

        return $this->redirectToRoute('etat_index');
    }

    /**
     * Crée un formulaire pour la suppression d'un état
     *
     * @param Etat $etat The etat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etat $etat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etat_delete', array('id' => $etat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
