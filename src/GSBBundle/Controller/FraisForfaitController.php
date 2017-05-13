<?php

namespace GSBBundle\Controller;

use GSBBundle\Entity\FraisForfait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controlleur du Crud fraisforfait réservé au super admin qui permet d'avoir les interfaces de gestions des fraisforfait
 * @Security("has_role('ROLE_COMPTABLE')")

 * @Route("fraisforfait")
 */
class FraisForfaitController extends Controller
{
    /**
     * Liste toutss les FraisForfaits.
     *
     * @Route("/", name="fraisforfait_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fraisForfaits = $em->getRepository('GSBBundle:FraisForfait')->findAll();

        return $this->render('fraisforfait/index.html.twig', array(
            'fraisForfaits' => $fraisForfaits,
        ));
    }

    /**
     * Crée un nouveau fraisForfait.
     *
     * @Route("/new", name="fraisforfait_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fraisForfait = new Fraisforfait();
        $form = $this->createForm('GSBBundle\Form\FraisForfaitType', $fraisForfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fraisForfait);
            $em->flush();

            return $this->redirectToRoute('fraisforfait_show', array('id' => $fraisForfait->getId()));
        }

        return $this->render('fraisforfait/new.html.twig', array(
            'fraisForfait' => $fraisForfait,
            'form' => $form->createView(),
        ));
    }

    /**
     * Recherche et affiche un fraisForfait.
     *
     * @Route("/{id}", name="fraisforfait_show")
     * @Method("GET")
     */
    public function showAction(FraisForfait $fraisForfait)
    {
        $deleteForm = $this->createDeleteForm($fraisForfait);

        return $this->render('fraisforfait/show.html.twig', array(
            'fraisForfait' => $fraisForfait,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Affiche un formulaire pour éditer un fraisForfait particulier
     *
     * @Route("/{id}/edit", name="fraisforfait_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FraisForfait $fraisForfait)
    {
        $deleteForm = $this->createDeleteForm($fraisForfait);
        $editForm = $this->createForm('GSBBundle\Form\FraisForfaitType', $fraisForfait);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fraisforfait_edit', array('id' => $fraisForfait->getId()));
        }

        return $this->render('fraisforfait/edit.html.twig', array(
            'fraisForfait' => $fraisForfait,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Supprime un fraisForfait particulier
     *
     * @Route("/{id}", name="fraisforfait_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FraisForfait $fraisForfait)
    {
        $form = $this->createDeleteForm($fraisForfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fraisForfait);
            $em->flush();
        }

        return $this->redirectToRoute('validFrais');
    }

    /**
     * Crée un formulaire pour supprimer un fraisForfait
     *
     * @param FraisForfait $fraisForfait The fraisForfait entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FraisForfait $fraisForfait)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fraisforfait_delete', array('id' => $fraisForfait->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
