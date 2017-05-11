<?php

namespace GSBBundle\Controller;

use GSBBundle\Entity\FicheFrais;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fichefrai controller.
 * @Security("has_role('ROLE_COMPTABLE')")
 * @Route("fichefrais")
 */
class FicheFraisController extends Controller
{
    /**
     * Lists toutes les ficheFrais.
     *
     * @Route("/", name="fichefrais_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ficheFrais = $em->getRepository('GSBBundle:FicheFrais')->findAll();

        return $this->render('fichefrais/index.html.twig', array(
            'ficheFrais' => $ficheFrais,
        ));
    }

    /**
     * Crée une nouvelle FicheFrais.
     *
     * @Route("/new", name="fichefrais_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ficheFrai = new Fichefrai();
        $form = $this->createForm('GSBBundle\Form\FicheFraisType', $ficheFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ficheFrai);
            $em->flush();

            return $this->redirectToRoute('fichefrais_show', array('id' => $ficheFrai->getId()));
        }

        return $this->render('fichefrais/new.html.twig', array(
            'ficheFrai' => $ficheFrai,
            'form' => $form->createView(),
        ));
    }

    /**
     * Recherche et affiche une ficheFrais.
     *
     * @Route("/{id}", name="fichefrais_show")
     * @Method("GET")
     */
    public function showAction(FicheFrais $ficheFrai)
    {
        $deleteForm = $this->createDeleteForm($ficheFrai);

        return $this->render('fichefrais/show.html.twig', array(
            'ficheFrai' => $ficheFrai,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Affiche un formulaire pour éditer une ficheFrais particulière
     *
     * @Route("/{id}/edit", name="fichefrais_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FicheFrais $ficheFrai)
    {
        $deleteForm = $this->createDeleteForm($ficheFrai);
        $editForm = $this->createForm('GSBBundle\Form\FicheFraisType', $ficheFrai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fichefrais_edit', array('id' => $ficheFrai->getId()));
        }

        return $this->render('fichefrais/edit.html.twig', array(
            'ficheFrai' => $ficheFrai,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Supprime une fiche Frais particulière
     *
     * @Route("/{id}", name="fichefrais_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FicheFrais $ficheFrai)
    {
        $form = $this->createDeleteForm($ficheFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ficheFrai);
            $em->flush();
        }

        return $this->redirectToRoute('fichefrais_index');
    }

    /**
     * Crée un formulaire pour supprimer une ficheFrais
     *
     * @param FicheFrais $ficheFrai The ficheFrai entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FicheFrais $ficheFrai)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fichefrais_delete', array('id' => $ficheFrai->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
