<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conducteur
 *
 * @ORM\Table(name="conducteur")
 * @ORM\Entity(repositoryClass="VehiculeBundle\Repository\ConducteurRepository")
 */
class Conducteur
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
     *@ORM\OneToMany(targetEntity="VehiculeBundle\Entity\Utilisation", mappedBy="conducteur")
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
     * @ORM\Column(name="prenoms", type="string", length=255)
     */
    private $prenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuDeNaissance", type="string", length=255)
     */
    private $lieuDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="permis", type="string", length=255)
     */
    private $permis;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255)
     */
    private $fonction;


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
     * @return Conducteur
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
     * Set prenoms
     *
     * @param string $prenoms
     *
     * @return Conducteur
     */
    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    /**
     * Get prenoms
     *
     * @return string
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * Set dateNaissance
     *
     * @param string $dateNaissance
     *
     * @return Conducteur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return string
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set lieuDeNaissance
     *
     * @param string $lieuDeNaissance
     *
     * @return Conducteur
     */
    public function setLieuDeNaissance($lieuDeNaissance)
    {
        $this->lieuDeNaissance = $lieuDeNaissance;

        return $this;
    }

    /**
     * Get lieuDeNaissance
     *
     * @return string
     */
    public function getLieuDeNaissance()
    {
        return $this->lieuDeNaissance;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Conducteur
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
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
     * @return Conducteur
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
     * Set email
     *
     * @param string $email
     *
     * @return Conducteur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Conducteur
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
     * Set permis
     *
     * @param string $permis
     *
     * @return Conducteur
     */
    public function setPermis($permis)
    {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Get permis
     *
     * @return string
     */
    public function getPermis()
    {
        return $this->permis;
    }
    
    public function __toString() {
        return $this->getNom()." ".$this->getPrenoms();
    }
    
}
