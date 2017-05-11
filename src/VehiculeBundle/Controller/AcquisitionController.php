<?php

namespace VehiculeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VehiculeBundle\Entity\Acquisition;
use VehiculeBundle\Form\AcquisitionType;

/**
 * Acquisition controller.
 *
 * @Route("/acquisition")
 */
class AcquisitionController extends Controller
{
    /**
     * Lists all Acquisition entities.
     *
     * @Route("/", name="acquisition_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $acquisitions = $em->getRepository('VehiculeBundle:Acquisition')->findAll();

        return $this->render('@Vehicule/@Vehicule/acquisition/index.html.twig', array(
            'acquisitions' => $acquisitions,
        ));
    }

    /**
     * Creates a new Acquisition entity.
     *
     * @Route("/new", name="acquisition_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $acquisition = new Acquisition();
        $form = $this->createForm('VehiculeBundle\Form\AcquisitionType', $acquisition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acquisition);
            $em->flush();

            return $this->redirectToRoute('acquisition_show', array('id' => $acquisition->getId()));
        }

        return $this->render('@Vehicule/@Vehicule/acquisition/new.html.twig', array(
            'acquisition' => $acquisition,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Acquisition entity.
     *
     * @Route("/{id}", name="acquisition_show")
     * @Method("GET")
     */
    public function showAction(Acquisition $acquisition)
    {
        $deleteForm = $this->createDeleteForm($acquisition);

        return $this->render('@Vehicule/@Vehicule/acquisition/show.html.twig', array(
            'acquisition' => $acquisition,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Acquisition entity.
     *
     * @Route("/{id}/edit", name="acquisition_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Acquisition $acquisition)
    {
        $deleteForm = $this->createDeleteForm($acquisition);
        $editForm = $this->createForm('VehiculeBundle\Form\AcquisitionType', $acquisition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acquisition);
            $em->flush();

            return $this->redirectToRoute('acquisition_edit', array('id' => $acquisition->getId()));
        }

        return $this->render('@Vehicule/@Vehicule/acquisition/edit.html.twig', array(
            'acquisition' => $acquisition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Acquisition entity.
     *
     * @Route("/{id}", name="acquisition_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Acquisition $acquisition)
    {
        $form = $this->createDeleteForm($acquisition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acquisition);
            $em->flush();
        }

        return $this->redirectToRoute('acquisition_index');
    }

    /**
     * Creates a form to delete a Acquisition entity.
     *
     * @param Acquisition $acquisition The Acquisition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Acquisition $acquisition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('acquisition_delete', array('id' => $acquisition->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
