<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="VehiculeBundle\Repository\ClientRepository")
 */
class Client
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
     *@ORM\OneToMany(targetEntity="VehiculeBundle\Entity\Utilisation", mappedBy="client")
     */
    private $utilisation;

    /*
     * *******************************************************
     */

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255)
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
        $this->utilisation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add utilisation
     *
     * @param \VehiculeBundle\Entity\Utilisation $utilisation
     *
     * @return Client
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
}
