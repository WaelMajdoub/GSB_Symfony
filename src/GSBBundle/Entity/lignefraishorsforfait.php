<?php

namespace GSBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * lignefraishorsforfait
 *
 * @ORM\Table(name="lignefraishorsforfait")
 * @ORM\Entity(repositoryClass="GSBBundle\Repository\lignefraishorsforfaitRepository")
 */
class lignefraishorsforfait
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idvisiteur", type="string", length=4)
     */
    private $idvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", length=6)
     */
    private $mois;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=100, nullable=true)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefraishf", type="datetime", nullable=true)
     */
    private $datefraishf;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montant;


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
     * Set idvisiteur
     *
     * @param string $idvisiteur
     *
     * @return lignefraishorsforfait
     */
    public function setIdvisiteur($idvisiteur)
    {
        $this->idvisiteur = $idvisiteur;

        return $this;
    }

    /**
     * Get idvisiteur
     *
     * @return string
     */
    public function getIdvisiteur()
    {
        return $this->idvisiteur;
    }

    /**
     * Set mois
     *
     * @param string $mois
     *
     * @return lignefraishorsforfait
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return lignefraishorsforfait
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
     * Set datefraishf
     *
     * @param \DateTime $datefraishf
     *
     * @return lignefraishorsforfait
     */
    public function setDatefraishf($datefraishf)
    {
        $this->datefraishf = $datefraishf;

        return $this;
    }

    /**
     * Get datefraishf
     *
     * @return \DateTime
     */
    public function getDatefraishf()
    {
        return $this->datefraishf;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return lignefraishorsforfait
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }
}

