<?php

namespace VehiculeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use VehiculeBundle\Entity\Client;
use VehiculeBundle\Form\ClientType;

/**
 * Client controller.
 *
 * @Route("/client")
 */
class ClientController extends Controller {

    /**
     * Lists all Client entities.
     *
     * @Route("/", name="client_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('VehiculeBundle:Client')->findAll();

        return $this->render('@Vehicule/client/index.html.twig', array(
                    'clients' => $clients,
        ));
    }

    /**
     * Creates a new Client entity.
     *
     * @Route("/new", name="client_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $client = new Client();
        $form = $this->createForm('VehiculeBundle\Form\ClientType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_show', array('id' => $client->getId()));
        }

        return $this->render('@Vehicule/client/new.html.twig', array(
                    'client' => $client,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Client entity.
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     */
    public function showAction(Client $client) {
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('@Vehicule/client/show.html.twig', array(
                    'client' => $client,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/a/client/{id}",
     *     defaults = { "id" = 0 },
     *     options = { "expose" = true },
     *     name = "ajax_route_client",
     * )
     */
    public function ajaxGetAction(Client $client) {
        $response = new JsonResponse();
        $response->setData($client);
        return $response;
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     * @Route("/{id}/edit", name="client_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Client $client) {
        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('VehiculeBundle\Form\ClientType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_edit', array('id' => $client->getId()));
        }

        return $this->render('@Vehicule/client/edit.html.twig', array(
                    'client' => $client,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Client entity.
     *
     * @Route("/{id}", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client) {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
