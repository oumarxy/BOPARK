<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisation
 *
 * @ORM\Table(name="utilisation")
 * @ORM\Entity(repositoryClass="VehiculeBundle\Repository\UtilisationRepository")
 */
class Utilisation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /*
     * RELATIONS
     */

    /**
     * @ORM\ManyToOne(targetEntity="VehiculeBundle\Entity\Vehicule", inversedBy="utilisation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $vehicule;

    /**
     * @ORM\ManyToOne(targetEntity="VehiculeBundle\Entity\Client", inversedBy="utilisation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity="VehiculeBundle\Entity\Trajet", cascade={"persist"})
     */
    private $trajet;


    /**
     * @ORM\ManyToOne(targetEntity="VehiculeBundle\Entity\Conducteur", inversedBy="utilisation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conducteur;

    /*
     * *******************************************************
     */

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
     */
    private $dateFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebut", type="time")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="time")
     */
    private $heureFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFinReel", type="time", nullable=true)
     */
    private $heureFinReel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinReel", type="datetime", nullable=true)
     */
    private $dateFinReel;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="kilometrageDepart", type="integer", nullable=true)
     */
    private $kilometrageDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="kilometrageArrivee", type="integer", nullable=true)
     */
    private $kilometrageArrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="etatCarburantDepart", type="string", nullable=true)
     */
    private $etatCarburantDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="etatCarburantArrivee", type="string", nullable=true)
     */
    private $etatCarburantArrivee;






    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Utilisation
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Utilisation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set heureDebut
     *
     * @param string $heureDebut
     *
     * @return Utilisation
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return string
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param string $heureFin
     *
     * @return Utilisation
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return string
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set heureFinReel
     *
     * @param string $heureFinReel
     *
     * @return Utilisation
     */
    public function setHeureFinReel($heureFinReel)
    {
        $this->heureFinReel = $heureFinReel;

        return $this;
    }

    /**
     * Get heureFinReel
     *
     * @return string
     */
    public function getHeureFinReel()
    {
        return $this->heureFinReel;
    }

    /**
     * Set dateFinReel
     *
     * @param \DateTime $dateFinReel
     *
     * @return Utilisation
     */
    public function setDateFinReel($dateFinReel)
    {
        $this->dateFinReel = $dateFinReel;

        return $this;
    }

    /**
     * Get dateFinReel
     *
     * @return \DateTime
     */
    public function getDateFinReel()
    {
        return $this->dateFinReel;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Utilisation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Utilisation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set kilometrageDepart
     *
     * @param integer $kilometrageDepart
     *
     * @return Utilisation
     */
    public function setKilometrageDepart($kilometrageDepart)
    {
        $this->kilometrageDepart = $kilometrageDepart;

        return $this;
    }

    /**
     * Get kilometrageDepart
     *
     * @return integer
     */
    public function getKilometrageDepart()
    {
        return $this->kilometrageDepart;
    }

    /**
     * Set kilometrageArrivee
     *
     * @param integer $kilometrageArrivee
     *
     * @return Utilisation
     */
    public function setKilometrageArrivee($kilometrageArrivee)
    {
        $this->kilometrageArrivee = $kilometrageArrivee;

        return $this;
    }

    /**
     * Get kilometrageArrivee
     *
     * @return integer
     */
    public function getKilometrageArrivee()
    {
        return $this->kilometrageArrivee;
    }

    /**
     * Set etatCarburantDepart
     *
     * @param string $etatCarburantDepart
     *
     * @return Utilisation
     */
    public function setEtatCarburantDepart($etatCarburantDepart)
    {
        $this->etatCarburantDepart = $etatCarburantDepart;

        return $this;
    }

    /**
     * Get etatCarburantDepart
     *
     * @return string
     */
    public function getEtatCarburantDepart()
    {
        return $this->etatCarburantDepart;
    }

    /**
     * Set etatCarburantArrivee
     *
     * @param string $etatCarburantArrivee
     *
     * @return Utilisation
     */
    public function setEtatCarburantArrivee($etatCarburantArrivee)
    {
        $this->etatCarburantArrivee = $etatCarburantArrivee;

        return $this;
    }

    /**
     * Get etatCarburantArrivee
     *
     * @return string
     */
    public function getEtatCarburantArrivee()
    {
        return $this->etatCarburantArrivee;
    }

    /**
     * Set vehicule
     *
     * @param \VehiculeBundle\Entity\Vehicule $vehicule
     *
     * @return Utilisation
     */
    public function setVehicule(\VehiculeBundle\Entity\Vehicule $vehicule = null)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return \VehiculeBundle\Entity\Vehicule
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set client
     *
     * @param \VehiculeBundle\Entity\Client $client
     *
     * @return Utilisation
     */
    public function setClient(\VehiculeBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \VehiculeBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }


    /**
     * Set conducteur
     *
     * @param \VehiculeBundle\Entity\Conducteur $conducteur
     *
     * @return Utilisation
     */
    public function setConducteur(\VehiculeBundle\Entity\Conducteur $conducteur)
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    /**
     * Get conducteur
     *
     * @return \VehiculeBundle\Entity\Conducteur
     */
    public function getConducteur()
    {
        return $this->conducteur;
    }

    /**
     * Set trajet
     *
     * @param \VehiculeBundle\Entity\Trajet $trajet
     *
     * @return Utilisation
     */
    public function setTrajet(\VehiculeBundle\Entity\Trajet $trajet = null)
    {
        $this->trajet = $trajet;

        return $this;
    }

    /**
     * Get trajet
     *
     * @return \VehiculeBundle\Entity\Trajet
     */
    public function getTrajet()
    {
        return $this->trajet;
    }
}
