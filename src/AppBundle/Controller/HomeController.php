<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Home controller.
 *
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     *
     * @Route("/", name="home_index")
     * @Method("GET")
     */
    public function indexAction()
    {
           
        $em = $this->getDoctrine()->getManager();

        $vehicules = $em->getRepository('VehiculeBundle:Vehicule')->findAll();
        $utilisation = $em->getRepository('VehiculeBundle:Utilisation')->findAll();
        $conducteur = $em->getRepository('VehiculeBundle:Conducteur')->findAll();
        
        $countVehicule = count($vehicules);
        $countUtilisation = count($utilisation);
        $countConducteur = count($conducteur);
        return $this->render('@App/home/index.html.twig', array(
            'countVehicule' => $countVehicule,
            'countUtilisation' => $countUtilisation,
            'countConducteur' => $countConducteur,
        ));
    }
  
}
