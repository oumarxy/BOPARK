<?php

namespace VehiculeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VehiculeBundle\Entity\Conducteur;
use VehiculeBundle\Form\ConducteurType;

/**
 * Conducteur controller.
 *
 * @Route("/conducteur")
 */
class ConducteurController extends Controller {

    /**
     * Lists all Conducteur entities.
     *
     * @Route("/", name="conducteur_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $conducteurs = $em->getRepository('VehiculeBundle:Conducteur')->findAll();

        $conducteur = new Conducteur();
        $form = $this->createForm('VehiculeBundle\Form\ConducteurType', $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($conducteur);
            $em->flush();
            return $this->redirect($request->getUri());
        }

        return $this->render('@Vehicule/conducteur/index.html.twig', array(
                    'conducteurs' => $conducteurs,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Conducteur entity.
     *
     * @Route("/new", name="conducteur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $conducteur = new Conducteur();
        $form = $this->createForm('VehiculeBundle\Form\ConducteurType', $conducteur);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conducteur);
            $em->flush();

            return $this->redirectToRoute('conducteur_show', array('id' => $conducteur->getId()));
        }

        return $this->render('@Vehicule/conducteur/new.html.twig', array(
                    'conducteur' => $conducteur,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Conducteur entity.
     *
     * @Route("/{id}", name="conducteur_show")
     * @Method("GET")
     */
    public function showAction(Conducteur $conducteur) {
        $deleteForm = $this->createDeleteForm($conducteur);

        return $this->render('@Vehicule/conducteur/show.html.twig', array(
                    'conducteur' => $conducteur,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/a/conducteur/{id}",
     *     defaults = { "id" = 0 },
     *     options = { "expose" = true },
     *     name = "ajax_route_conducteur",
     * )
     */
    public function ajaxGetAction(Conducteur $conducteur) {
        $response = new JsonResponse();
        $data = array(
            'fonction' => $conducteur->getFonction(),
            'permis' => $conducteur->getPermis(),
            'contact' => $conducteur->getContact(),
            'email' => $conducteur->getEmail(),
        );
        $response->setData($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing Conducteur entity.
     *
     * @Route("/{id}/edit", name="conducteur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Conducteur $conducteur) {
        $deleteForm = $this->createDeleteForm($conducteur);
        $editForm = $this->createForm('VehiculeBundle\Form\ConducteurType', $conducteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conducteur);
            $em->flush();

            return $this->redirectToRoute('conducteur_edit', array('id' => $conducteur->getId()));
        }

        return $this->render('@Vehicule/conducteur/edit.html.twig', array(
                    'conducteur' => $conducteur,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Conducteur entity.
     *
     * @Route("/{id}", name="conducteur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Conducteur $conducteur) {
        $form = $this->createDeleteForm($conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conducteur);
            $em->flush();
        }

        return $this->redirectToRoute('conducteur_index');
    }

    /**
     * Creates a form to delete a Conducteur entity.
     *
     * @param Conducteur $conducteur The Conducteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Conducteur $conducteur) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('conducteur_delete', array('id' => $conducteur->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
