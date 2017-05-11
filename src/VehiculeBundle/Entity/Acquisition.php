<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acquisition
 *
 * @ORM\Table(name="acquisition")
 * @ORM\Entity(repositoryClass="VehiculeBundle\Repository\AcquisitionRepository")
 */
class Acquisition
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
     *@ORM\ManyToOne(targetEntity="VehiculeBundle\Entity\Fournisseur", inversedBy="acquisition")
     */
    private $fournisseur;

    /*
     * *******************************************************
     */

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;




    /**
     * @var string
     *
     * @ORM\Column(name="dateAcquisition", type="date", length=255)
     */
    private $dateAcquisition;

    /**
     * @var string
     *
     * @ORM\Column(name="montantAcquisition", type="integer")
     */
    private $montantAcquisition;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinLocation", type="date", nullable=true)
     */
    private $dateFinLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinLeasing", type="date", nullable=true)
     */
    private $dateFinLeasing;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Acquisition
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dateAcquisition
     *
     * @param \DateTime $dateAcquisition
     *
     * @return Acquisition
     */
    public function setDateAcquisition($dateAcquisition)
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }

    /**
     * Get dateAcquisition
     *
     * @return \DateTime
     */
    public function getDateAcquisition()
    {
        return $this->dateAcquisition;
    }

    /**
     * Set montantAcquisition
     *
     * @param \DateTime $montantAcquisition
     *
     * @return Acquisition
     */
    public function setMontantAcquisition($montantAcquisition)
    {
        $this->montantAcquisition = $montantAcquisition;

        return $this;
    }

    /**
     * Get montantAcquisition
     *
     * @return \DateTime
     */
    public function getMontantAcquisition()
    {
        return $this->montantAcquisition;
    }

    /**
     * Set dateFinLocation
     *
     * @param \DateTime $dateFinLocation
     *
     * @return Acquisition
     */
    public function setDateFinLocation($dateFinLocation)
    {
        $this->dateFinLocation = $dateFinLocation;

        return $this;
    }

    /**
     * Get dateFinLocation
     *
     * @return \DateTime
     */
    public function getDateFinLocation()
    {
        return $this->dateFinLocation;
    }

    /**
     * Set dateFinLeasing
     *
     * @param \DateTime $dateFinLeasing
     *
     * @return Acquisition
     */
    public function setDateFinLeasing($dateFinLeasing)
    {
        $this->dateFinLeasing = $dateFinLeasing;

        return $this;
    }

    /**
     * Get dateFinLeasing
     *
     * @return \DateTime
     */
    public function getDateFinLeasing()
    {
        return $this->dateFinLeasing;
    }

    /**
     * Set fournisseur
     *
     * @param \VehiculeBundle\Entity\Fournisseur $fournisseur
     *
     * @return Acquisition
     */
    public function setFournisseur(\VehiculeBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \VehiculeBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }
}
