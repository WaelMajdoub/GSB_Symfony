<?php

namespace GSBBundle\Controller;

use GSBBundle\Entity\LigneFraisForfait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controlleur du Crud lignefraisforfait réservé au super admin qui permet d'avoir les interfaces de gestions des lignefraisforfait
 * @Security("has_role('ROLE_COMPTABLE')")
 * @Route("lignefraisforfait")
 */
class LigneFraisForfaitController extends Controller
{
    /**
     * Lists all ligneFraisForfait entities.
     *
     * @Route("/", name="lignefraisforfait_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ligneFraisForfaits = $em->getRepository('GSBBundle:LigneFraisForfait')->findAll();

        return $this->render('lignefraisforfait/index.html.twig', array(
            'ligneFraisForfaits' => $ligneFraisForfaits,
        ));
    }

    /**
     * Creates a new ligneFraisForfait entity.
     *
     * @Route("/new", name="lignefraisforfait_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ligneFraisForfait = new Lignefraisforfait();
        $form = $this->createForm('GSBBundle\Form\LigneFraisForfaitType', $ligneFraisForfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ligneFraisForfait);
            $em->flush();

            return $this->redirectToRoute('lignefraisforfait_show', array('id' => $ligneFraisForfait->getId()));
        }

        return $this->render('lignefraisforfait/new.html.twig', array(
            'ligneFraisForfait' => $ligneFraisForfait,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ligneFraisForfait entity.
     *
     * @Route("/{id}", name="lignefraisforfait_show")
     * @Method("GET")
     */
    public function showAction(LigneFraisForfait $ligneFraisForfait)
    {
        $deleteForm = $this->createDeleteForm($ligneFraisForfait);

        return $this->render('lignefraisforfait/show.html.twig', array(
            'ligneFraisForfait' => $ligneFraisForfait,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ligneFraisForfait entity.
     *
     * @Route("/{id}/edit", name="lignefraisforfait_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, LigneFraisForfait $ligneFraisForfait)
    {
        $deleteForm = $this->createDeleteForm($ligneFraisForfait);
        $editForm = $this->createForm('GSBBundle\Form\LigneFraisForfaitType', $ligneFraisForfait);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lignefraisforfait_edit', array('id' => $ligneFraisForfait->getId()));
        }

        return $this->render('lignefraisforfait/edit.html.twig', array(
            'ligneFraisForfait' => $ligneFraisForfait,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ligneFraisForfait entity.
     *
     * @Route("/{id}", name="lignefraisforfait_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, LigneFraisForfait $ligneFraisForfait)
    {
        $form = $this->createDeleteForm($ligneFraisForfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ligneFraisForfait);
            $em->flush();
        }

        return $this->redirectToRoute('lignefraisforfait_index');
    }

    /**
     * Creates a form to delete a ligneFraisForfait entity.
     *
     * @param LigneFraisForfait $ligneFraisForfait The ligneFraisForfait entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LigneFraisForfait $ligneFraisForfait)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lignefraisforfait_delete', array('id' => $ligneFraisForfait->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
