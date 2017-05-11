<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="VehiculeBundle\Repository\FournisseurRepository")
 */
class Fournisseur
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
     *@ORM\OneToMany(targetEntity="VehiculeBundle\Entity\Acquisition", mappedBy="fournisseur")
     */
    private $acquisition;

    /*
     * *******************************************************
     */

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Fournisseur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Fournisseur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Fournisseur
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->acquisition = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add acquisition
     *
     * @param \VehiculeBundle\Entity\Acquisition $acquisition
     *
     * @return Fournisseur
     */
    public function addAcquisition(\VehiculeBundle\Entity\Acquisition $acquisition)
    {
        $this->acquisition[] = $acquisition;

        return $this;
    }

    /**
     * Remove acquisition
     *
     * @param \VehiculeBundle\Entity\Acquisition $acquisition
     */
    public function removeAcquisition(\VehiculeBundle\Entity\Acquisition $acquisition)
    {
        $this->acquisition->removeElement($acquisition);
    }

    /**
     * Get acquisition
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcquisition()
    {
        return $this->acquisition;
    }
}
