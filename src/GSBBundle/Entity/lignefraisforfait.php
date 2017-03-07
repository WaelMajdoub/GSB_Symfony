<?php

namespace GSBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * lignefraisforfait
 *
 * @ORM\Table(name="lignefraisforfait")
 * @ORM\Entity(repositoryClass="GSBBundle\Repository\lignefraisforfaitRepository")
 */
class lignefraisforfait
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
     * @ORM\Column(name="idfraisforfait", type="string", length=3)
     */
    private $idfraisforfait;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;


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
     * @return lignefraisforfait
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
     * @return lignefraisforfait
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
     * Set idfraisforfait
     *
     * @param string $idfraisforfait
     *
     * @return lignefraisforfait
     */
    public function setIdfraisforfait($idfraisforfait)
    {
        $this->idfraisforfait = $idfraisforfait;

        return $this;
    }

    /**
     * Get idfraisforfait
     *
     * @return string
     */
    public function getIdfraisforfait()
    {
        return $this->idfraisforfait;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return lignefraisforfait
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
}

