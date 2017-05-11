<?php

namespace VehiculeBundle\Controller;

use VehiculeBundle\Entity\Utilisation;
use VehiculeBundle\Entity\Vehicule;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VehiculeBundle\Form\UtilisationType;

/**
 * Utilisation controller.
 *
 * @Route("/utilisation")
 */
class UtilisationController extends Controller
{


    /**
     * Lists all Utilisation entities.
     *
     * @Route("/", name="utilisation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisations = $em->getRepository('VehiculeBundle:Utilisation')->findAll();

        $total = $this->getTotal();


        return $this->render('@Vehicule/utilisation/index.html.twig', array(
            'utilisations' => $utilisations,
            'total' => $total["tout"],
            'total_encours' => $total["encours"],
            'total_enattente' => $total["attente"],
            'total_termine' => $total["termine"],
            'total_annule' => $total["annule"],
        ));
    }

    /**
     * Lists all Utilisation entities.
     *
     * @Route("/vehicule/{id}/attente", name="utilisation_vehicule_attente")
     * @Method("GET")
     */
    public function indexVehiculeAttenteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $utilisations = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array("etat" => "En attente", "vehicule" => $id));

        return $this->render('@Vehicule/utilisation/index_vehicule_attente.html.twig', array(
            'utilisations' => $utilisations,
        ));
    }


    /**
     * @Route("/annule", name="utilisation_index_annule")
     * @Method("GET")
     */
    public function indexAnnuleAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisations = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'Annulé'));
        $total = $this->getTotal();

        return $this->render('@Vehicule/utilisation/index_annule.html.twig', array(
            'utilisations' => $utilisations,
            'total' => $total["tout"],
            'total_encours' => $total["encours"],
            'total_enattente' => $total["attente"],
            'total_termine' => $total["termine"],
            'total_annule' => $total["annule"],
        ));
    }

    /**
     * @Route("/attente", name="utilisation_index_attente")
     * @Method("GET")
     */
    public function indexAttenteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisations = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'En attente'));
        $total = $this->getTotal();

        return $this->render('@Vehicule/utilisation/index_attente.html.twig', array(
            'utilisations' => $utilisations,
            'total' => $total["tout"],
            'total_encours' => $total["encours"],
            'total_enattente' => $total["attente"],
            'total_termine' => $total["termine"],
            'total_annule' => $total["annule"],
        ));
    }

    /**
     * @Route("/termine", name="utilisation_index_termine")
     * @Method("GET")
     */
    public function indexTermineAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisations = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'Terminé'));
        $total = $this->getTotal();

        return $this->render('@Vehicule/utilisation/index_termine.html.twig', array(
            'utilisations' => $utilisations,
            'total' => $total["tout"],
            'total_encours' => $total["encours"],
            'total_enattente' => $total["attente"],
            'total_termine' => $total["termine"],
            'total_annule' => $total["annule"],
        ));
    }

    /**
     * @Route("/encours", name="utilisation_index_encours")
     * @Method("GET")
     */
    public function indexEncoursAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisations = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'En cours'));
        $total = $this->getTotal();

        return $this->render('@Vehicule/utilisation/index_encours.html.twig', array(
            'utilisations' => $utilisations,
            'total' => $total["tout"],
            'total_encours' => $total["encours"],
            'total_enattente' => $total["attente"],
            'total_termine' => $total["termine"],
            'total_annule' => $total["annule"],
        ));
    }

    /**
     * Creates a new Utilisation entity.
     *
     * @Route("/new", name="utilisation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $utilisation = new Utilisation();
        $form = $this->createForm('VehiculeBundle\Form\UtilisationType', $utilisation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach ($utilisation->getTrajet() as $trajet) {
                $em->persist($trajet);
            }
            $utilisation->setEtat("En attente");
            $em->persist($utilisation);
            $em->flush();

            return $this->redirectToRoute('utilisation_show', array('id' => $utilisation->getId()));
        }

        return $this->render('@Vehicule/utilisation/new.html.twig', array(
            'utilisation' => $utilisation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Utilisation entity.
     *
     * @Route("/{id}", name="utilisation_show")
     * @Method("GET")
     */
    public function showAction(Utilisation $utilisation)
    {
        $deleteForm = $this->createDeleteForm($utilisation);
        $editForm = $this->createForm('VehiculeBundle\Form\UtilisationType', $utilisation);

        return $this->render('@Vehicule/utilisation/show.html.twig', array(
            'utilisation' => $utilisation,
            'delete_form' => $deleteForm->createView(),
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Utilisation entity.
     *
     * @Route("/{id}/edit", name="utilisation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Utilisation $utilisation)
    {

        $ancienVehicule = $utilisation->getVehicule();

        $deleteForm = $this->createDeleteForm($utilisation);
        $editForm = $this->createForm('VehiculeBundle\Form\UtilisationType', $utilisation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $utilisations = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array("etat" => "En cours"));

            $i = 0;
            foreach ($utilisations as $u) {
                if ($u->getVehicule()->getId() == $ancienVehicule->getId()) {
                    $i++;
                    $id = $u->getId();
                }
            }
            if ($i == 0) {
                $ancienVehicule->setDisponibilite("Disponible");
            } else {
                if ($utilisation->getEtat() == "En cours") {
                    return $this->redirectToRoute('utilisation_show', array('id' => $id));
                }
            }

            /*
            if($ancienneDisponibiliteVehicule == "Indisponible"){
                $utilisationUsed = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat'=>'En cours', 'vehicule'=>$idAncienVehicule));
                //var_dump($ancienneDisponibiliteVehicule);die;
                return $this->redirectToRoute('utilisation_show', array('id' => $utilisationUsed->getId()));
            }

            if($ancienVehicule !=  $utilisation->getVehicule() && $ancienneutilisation->getEtat() == "En cours"){
              $ancienVehicule->setDisponibilite("Disponible");
            }*/

            $utilisationIndisponible = $em->getRepository('VehiculeBundle:Utilisation')
                ->findOneBy(array("vehicule" => $utilisation->getVehicule()->getId(), "etat" => "En cours"));

            if ($utilisation->getEtat() == "En cours") {
                $utilisation->getVehicule()->setDisponibilite("Indisponible");
            } else {
                if ($utilisationIndisponible == null || $utilisationIndisponible->getId() == $utilisation->getId()) {
                    $utilisation->getVehicule()->setDisponibilite("Disponible");
                }
            }

            $em->persist($ancienVehicule);
            $em->persist($utilisation);
            $em->flush();
            return $this->redirectToRoute('utilisation_show', array('id' => $utilisation->getId()));
        }

        return $this->render('@Vehicule/utilisation/edit.html.twig', array(
            'utilisation' => $utilisation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Utilisation entity.
     *
     * @Route("/{id}", name="utilisation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Utilisation $utilisation)
    {
        $form = $this->createDeleteForm($utilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisation);
            $em->flush();
        }

        return $this->redirectToRoute('utilisation_index');
    }

    /**
     * Creates a form to delete a Utilisation entity.
     *
     * @param Utilisation $utilisation The Utilisation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Utilisation $utilisation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisation_delete', array('id' => $utilisation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    private function getTotal()
    {
        $em = $this->getDoctrine()->getManager();

        $total_tout = $em->getRepository('VehiculeBundle:Utilisation')->findAll();
        $total_annule = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'Annulé'));
        $total_attente = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'En attente'));
        $total_termine = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'Terminé'));
        $total_encours = $em->getRepository('VehiculeBundle:Utilisation')->findBy(array('etat' => 'En cours'));

        $total = array(
            "tout" => count($total_tout),
            "annule" => count($total_annule),
            "attente" => count($total_attente),
            "termine" => count($total_termine),
            "encours" => count($total_encours)
        );

        return $total;
    }
}
