<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity(repositoryClass="VehiculeBundle\Repository\VehiculeRepository")
 */
class Vehicule
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
     *@ORM\OneToMany(targetEntity="VehiculeBundle\Entity\Utilisation", mappedBy="vehicule")
     */
    private $utilisation;

    /**
     *@ORM\ManyToOne(targetEntity="VehiculeBundle\Entity\Marque")
     */
    private $marque;

    /**
     *@ORM\ManyToOne(targetEntity="VehiculeBundle\Entity\Categorie")
     */
    private $categorie;

    /**
     *@ORM\OneToOne(targetEntity="VehiculeBundle\Entity\Acquisition")
     */
    private $acquisition;

    /*
     * *******************************************************
     */

    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=255, unique=true)
     */
    private $immatriculation;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroCarteGrise", type="string", length=255, unique=true)
     * 
     * @Assert\NotBlank()
     */
    private $numeroCarteGrise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMiseEnCirculation", type="date", nullable=true)
     */
    private $dateMiseEnCirculation;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroChassis", type="string", length=255, unique=true)
     */
    private $numeroChassis;

    /**
     * @var string
     *
     * @ORM\Column(name="poids", type="string", length=255, nullable=true)
     */
    private $poids;

    /**
     * @var int
     *
     * @ORM\Column(name="kilometrage", type="integer", nullable=true)
     */
    private $kilometrage;

    /**
     * @var int
     *
     * @ORM\Column(name="place", type="integer", nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255, nullable=true)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilite", type="string", length=255, nullable=true)
     */
    private $disponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="typeacquisition", type="string", length=255)
     */
    private $typeacquisition;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    private $path;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set immatriculation
     *
     * @param string $immatriculation
     *
     * @return Vehicule
     */
    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    /**
     * Get immatriculation
     *
     * @return string
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Set numeroCarteGrise
     *
     * @param string $numeroCarteGrise
     *
     * @return Vehicule
     */
    public function setNumeroCarteGrise($numeroCarteGrise)
    {
        $this->numeroCarteGrise = $numeroCarteGrise;

        return $this;
    }

    /**
     * Get numeroCarteGrise
     *
     * @return string
     */
    public function getNumeroCarteGrise()
    {
        return $this->numeroCarteGrise;
    }

    /**
     * Set dateMiseEnCirculation
     *
     * @param \DateTime $dateMiseEnCirculation
     *
     * @return Vehicule
     */
    public function setDateMiseEnCirculation($dateMiseEnCirculation)
    {
        $this->dateMiseEnCirculation = $dateMiseEnCirculation;

        return $this;
    }

    /**
     * Get dateMiseEnCirculation
     *
     * @return \DateTime
     */
    public function getDateMiseEnCirculation()
    {
        return $this->dateMiseEnCirculation;
    }

    /**
     * Set numeroChassis
     *
     * @param string $numeroChassis
     *
     * @return Vehicule
     */
    public function setNumeroChassis($numeroChassis)
    {
        $this->numeroChassis = $numeroChassis;

        return $this;
    }

    /**
     * Get numeroChassis
     *
     * @return string
     */
    public function getNumeroChassis()
    {
        return $this->numeroChassis;
    }

    /**
     * Set poids
     *
     * @param string $poids
     *
     * @return Vehicule
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return string
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set kilometrage
     *
     * @param integer $kilometrage
     *
     * @return Vehicule
     */
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    /**
     * Get kilometrage
     *
     * @return int
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Vehicule
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add utilisation
     *
     * @param \VehiculeBundle\Entity\Utilisation $utilisation
     *
     * @return Vehicule
     */
    public function addUtilisation(\VehiculeBundle\Entity\Utilisation $utilisation)
    {
        $this->utilisation[] = $utilisation;

        return $this;
    }

    /**
     * Remove utilisation
     *
     * @param \VehiculeBundle\Entity\Utilisation $utilisation
     */
    public function removeUtilisation(\VehiculeBundle\Entity\Utilisation $utilisation)
    {
        $this->utilisation->removeElement($utilisation);
    }

    /**
     * Get utilisation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisation()
    {
        return $this->utilisation;
    }

    /**
     * Set marque
     *
     * @param \VehiculeBundle\Entity\Marque $marque
     *
     * @return Vehicule
     */
    public function setMarque(\VehiculeBundle\Entity\Marque $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \VehiculeBundle\Entity\Marque
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set categorie
     *
     * @param \VehiculeBundle\Entity\Categorie $categorie
     *
     * @return Vehicule
     */
    public function setCategorie(\VehiculeBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \VehiculeBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set acquisition
     *
     * @param \VehiculeBundle\Entity\Acquisition $acquisition
     *
     * @return Vehicule
     */
    public function setAcquisition(\VehiculeBundle\Entity\Acquisition $acquisition = null)
    {
        $this->acquisition = $acquisition;

        return $this;
    }

    /**
     * Get acquisition
     *
     * @return \VehiculeBundle\Entity\Acquisition
     */
    public function getAcquisition()
    {
        return $this->acquisition;
    }

    /**
     * Set typeacquisition
     *
     * @param string $typeacquisition
     *
     * @return Vehicule
     */
    public function setTypeacquisition($typeacquisition)
    {
        $this->typeacquisition = $typeacquisition;

        return $this;
    }

    /**
     * Get typeacquisition
     *
     * @return string
     */
    public function getTypeacquisition()
    {
        return $this->typeacquisition;
    }

    /**
     * Set place
     *
     * @param integer $place
     *
     * @return Vehicule
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer
     */
    public function getPlace()
    {
        return $this->place;
    }
    
    public function __toString() {
        return $this->getImmatriculation();
    }

    /**
     * Set disponibilite
     *
     * @param string $disponibilite
     *
     * @return Vehicule
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return string
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Vehicule
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
