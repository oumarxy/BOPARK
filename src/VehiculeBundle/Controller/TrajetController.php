<?php

namespace VehiculeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VehiculeBundle\Entity\Trajet;
use VehiculeBundle\Form\TrajetType;

/**
 * Trajet controller.
 *
 * @Route("/trajet")
 */
class TrajetController extends Controller
{
    /**
     * Lists all Trajet entities.
     *
     * @Route("/", name="trajet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trajets = $em->getRepository('VehiculeBundle:Trajet')->findAll();

        return $this->render('@Vehicule/trajet/index.html.twig', array(
            'trajets' => $trajets,
        ));
    }

    /**
     * Creates a new Trajet entity.
     *
     * @Route("/new", name="trajet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $trajet = new Trajet();
        $form = $this->createForm('VehiculeBundle\Form\TrajetType', $trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trajet);
            $em->flush();

            return $this->redirectToRoute('trajet_show', array('id' => $trajet->getId()));
        }

        return $this->render('@Vehicule/trajet/new.html.twig', array(
            'trajet' => $trajet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Trajet entity.
     *
     * @Route("/{id}", name="trajet_show")
     * @Method("GET")
     */
    public function showAction(Trajet $trajet)
    {
        $deleteForm = $this->createDeleteForm($trajet);

        return $this->render('@Vehicule/trajet/show.html.twig', array(
            'trajet' => $trajet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Trajet entity.
     *
     * @Route("/{id}/edit", name="trajet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Trajet $trajet)
    {
        $deleteForm = $this->createDeleteForm($trajet);
        $editForm = $this->createForm('VehiculeBundle\Form\TrajetType', $trajet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trajet);
            $em->flush();

            return $this->redirectToRoute('trajet_edit', array('id' => $trajet->getId()));
        }

        return $this->render('@Vehicule/trajet/edit.html.twig', array(
            'trajet' => $trajet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Trajet entity.
     *
     * @Route("/{id}", name="trajet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Trajet $trajet)
    {
        $form = $this->createDeleteForm($trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trajet);
            $em->flush();
        }

        return $this->redirectToRoute('trajet_index');
    }

    /**
     * Creates a form to delete a Trajet entity.
     *
     * @param Trajet $trajet The Trajet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trajet $trajet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trajet_delete', array('id' => $trajet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
