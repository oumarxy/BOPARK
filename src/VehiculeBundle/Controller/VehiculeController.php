<?php

namespace VehiculeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VehiculeBundle\Entity\Vehicule;
use VehiculeBundle\Form\VehiculeType;

/**
 * Vehicule controller.
 *
 * @Route("/vehicule")
 */
class VehiculeController extends Controller {

    /**
     * Lists all Vehicule entities.
     *
     * @Route("/{statut}", name="vehicule_index", defaults={"statut"="tout"})
     * @Method("GET")
     */
    public function indexAction($statut) {
        $em = $this->getDoctrine()->getManager();
        if ($statut == "disponible") {
            $vehicules = $em->getRepository('VehiculeBundle:Vehicule')->findBy(array("disponibilite" => "Disponible"));
        } elseif ($statut == "indisponible") {
            $vehicules = $em->getRepository('VehiculeBundle:Vehicule')->findBy(array("disponibilite" => "Indisponible"));
        } else {
            $vehicules = $em->getRepository('VehiculeBundle:Vehicule')->findAll();
        }
        $total = $this->getTotal();

        return $this->render('@Vehicule/vehicule/index.html.twig', array(
                    'vehicules' => $vehicules,
                    'total_tout' => $total["tout"],
                    'total_disponible' => $total["disponible"],
                    'total_indisponible' => $total["indisponible"],
        ));
    }

    /**
     * Lists all Vehicule entities.
     *
     * @Route("/recherche/utilisation/{id}", name="vehicule_recherche_utilisation")
     * @Method("GET")
     */
    public function rechercheUtilisationAction(Vehicule $vehicule) {

        $em = $this->getDoctrine()->getManager();

        $utilisation = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'En cours'));

        foreach ($utilisation as $u) {
            if ($u->getVehicule()->getId() == $vehicule->getId()) {
                $id = $u->getId();
            }
        }

        $this->get('session')->getFlashBag()->add('info', 'Ce véhicule est en cours d\'utilisation.');
        return $this->redirectToRoute('utilisation_show', array('id' => $id));
    }

    /**
     * Creates a new Vehicule entity.
     *
     * @Route("/new/v", name="vehicule_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $vehicule = new Vehicule();
        $form = $this->createForm('VehiculeBundle\Form\VehiculeType', $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $vehicule->setDisponibilite("Disponible");

            $file = $vehicule->getPath();
            $folder = 'vehicules';
            $fileName = $this->get('app.my_uploader')->upload($file, $folder);
            $vehicule->setPath($fileName);

            $em->persist($vehicule);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Nouveau véhicule ajouté.');
            return $this->redirectToRoute('vehicule_show', array('id' => $vehicule->getId()));
        }

        return $this->render('@Vehicule/vehicule/new.html.twig', array(
                    'vehicule' => $vehicule,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vehicule entity.
     *
     * @Route("/s/{id}", name="vehicule_show")
     * @Method("GET")
     */
    public function showAction(Vehicule $vehicule) {
        $deleteForm = $this->createDeleteForm($vehicule);

        return $this->render('@Vehicule/vehicule/show.html.twig', array(
                    'vehicule' => $vehicule,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/a/vehicule/{id}",
     *     defaults = { "id" = 0 },
     *     options = { "expose" = true },
     *     name = "ajax_route_vehicule",
     * )
     */
    public function ajaxGetAction(Vehicule $vehicule) {
        $response = new JsonResponse();
        $data = array(
            'immatriculation' => $vehicule->getImmatriculation(),
            'place' => $vehicule->getPlace(),
            'Poids' => $vehicule->getPoids(),
        );
        $response->setData($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing Vehicule entity.
     *
     * @Route("/{id}/edit", name="vehicule_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Vehicule $vehicule) {

        $oldfile = $vehicule->getPath();
        $deleteForm = $this->createDeleteForm($vehicule);
        $editForm = $this->createForm('VehiculeBundle\Form\VehiculeType', $vehicule);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file = $vehicule->getPath();
            if (is_file($file)) {
                $folder = 'vehicules';
                $fileName = $this->get('app.my_uploader')->upload($file, $folder);
                $vehicule->setPath($fileName);
                if ($oldfile->getFilename() != 'default_vehicule.png') {
                    unlink($oldfile);
                }
            } else {
                $vehicule->setPath($oldfile->getFilename());
            }

            $em->persist($vehicule);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Modification effectuée avec succès');
            //var_dump($this->get('session')->getFlashBag());die;
            return $this->redirectToRoute('vehicule_show', array('id' => $vehicule->getId()));
        }
        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->get('session')->getFlashBag()->add('error', 'Modification non effectuée');
        }
        return $this->render('@Vehicule/vehicule/edit.html.twig', array(
                    'vehicule' => $vehicule,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vehicule entity.
     *
     * @Route("/{id}", name="vehicule_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Vehicule $vehicule) {
        $form = $this->createDeleteForm($vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicule);
            $em->flush();
        }

        return $this->redirectToRoute('vehicule_index');
    }

    /**
     * Creates a form to delete a Vehicule entity.
     *
     * @param Vehicule $vehicule The Vehicule entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vehicule $vehicule) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('vehicule_delete', array('id' => $vehicule->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    private function getTotal() {
        $em = $this->getDoctrine()->getManager();

        $total_tout = $em->getRepository('VehiculeBundle:Vehicule')->findAll();
        $total_disponible = $em->getRepository('VehiculeBundle:Vehicule')->findBy(array('disponibilite' => 'Disponible'));
        $total_indisponible = $em->getRepository('VehiculeBundle:Vehicule')->findBy(array('disponibilite' => 'Indisponible'));

        $total = array(
            "tout" => count($total_tout),
            "disponible" => count($total_disponible),
            "indisponible" => count($total_indisponible),
        );

        return $total;
    }

}
