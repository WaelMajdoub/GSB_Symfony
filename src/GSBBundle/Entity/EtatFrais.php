<?php

namespace GSBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatFrais
 *
 * @ORM\Table(name="etat_frais")
 * @ORM\Entity(repositoryClass="GSBBundle\Repository\EtatFraisRepository")
 */
class EtatFrais
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


    /**
     * @var ficheFrais
     *
     * @ORM\OneToMany(targetEntity="GSBBundle\Entity\LigneFraisHorsForfait", mappedBy="idEtatFrais")
     */
    private $ficheFrais;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return EtatFrais
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
     * Constructor
     */
    public function __construct()
    {
        $this->ficheFrais = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ficheFrai
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $ficheFrai
     *
     * @return EtatFrais
     */
    public function addFicheFrai(\GSBBundle\Entity\LigneFraisHorsForfait $ficheFrai)
    {
        $this->ficheFrais[] = $ficheFrai;

        return $this;
    }

    /**
     * Remove ficheFrai
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $ficheFrai
     */
    public function removeFicheFrai(\GSBBundle\Entity\LigneFraisHorsForfait $ficheFrai)
    {
        $this->ficheFrais->removeElement($ficheFrai);
    }

    /**
     * Get ficheFrais
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFicheFrais()
    {
        return $this->ficheFrais;
    }
}
