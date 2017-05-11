<?php

namespace VehiculeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VehiculeBundle\Entity\Marque;
use VehiculeBundle\Form\MarqueType;

/**
 * Marque controller.
 *
 * @Route("/marque")
 */
class MarqueController extends Controller
{
    /**
     * Lists all Marque entities.
     *
     * @Route("/", name="marque_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $marques = $em->getRepository('VehiculeBundle:Marque')->findAll();

        return $this->render('@Vehicule/marque/index.html.twig', array(
            'marques' => $marques,
        ));
    }

    /**
     * Creates a new Marque entity.
     *
     * @Route("/new", name="marque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $marque = new Marque();
        $form = $this->createForm('VehiculeBundle\Form\MarqueType', $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();

            return $this->redirectToRoute('marque_show', array('id' => $marque->getId()));
        }

        return $this->render('@Vehicule/marque/new.html.twig', array(
            'marque' => $marque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Marque entity.
     *
     * @Route("/{id}", name="marque_show")
     * @Method("GET")
     */
    public function showAction(Marque $marque)
    {
        $deleteForm = $this->createDeleteForm($marque);

        return $this->render('@Vehicule/marque/show.html.twig', array(
            'marque' => $marque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Marque entity.
     *
     * @Route("/{id}/edit", name="marque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Marque $marque)
    {
        $deleteForm = $this->createDeleteForm($marque);
        $editForm = $this->createForm('VehiculeBundle\Form\MarqueType', $marque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();

            return $this->redirectToRoute('marque_edit', array('id' => $marque->getId()));
        }

        return $this->render('@Vehicule/marque/edit.html.twig', array(
            'marque' => $marque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Marque entity.
     *
     * @Route("/{id}", name="marque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Marque $marque)
    {
        $form = $this->createDeleteForm($marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($marque);
            $em->flush();
        }

        return $this->redirectToRoute('marque_index');
    }

    /**
     * Creates a form to delete a Marque entity.
     *
     * @param Marque $marque The Marque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Marque $marque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('marque_delete', array('id' => $marque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
