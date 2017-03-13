<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\LigneFraisForfaitRepository")
 */
class LigneFraisForfait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mois;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="FraisForfait")
     * @ORM\JoinColumn(name="idFraisForfait", referencedColumnName="id")
     */
    private $fraisforfait;

    /**
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     */
    private $visiteur;

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
     * Set mois
     *
     * @param string $mois
     *
     * @return LigneFraisForfait
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LigneFraisForfait
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set fraisforfait
     *
     * @param \GSBBundle\Entity\FraisForfait $fraisforfait
     *
     * @return LigneFraisForfait
     */
    public function setFraisforfait(\GSBBundle\Entity\FraisForfait $fraisforfait = null)
    {
        $this->fraisforfait = $fraisforfait;

        return $this;
    }

    /**
     * Get fraisforfait
     *
     * @return \GSBBundle\Entity\FraisForfait
     */
    public function getFraisforfait()
    {
        return $this->fraisforfait;
    }

    /**
     * Set visiteur
     *
     * @param \GSBBundle\Entity\Visiteur $visiteur
     *
     * @return LigneFraisForfait
     */
    public function setVisiteur(\GSBBundle\Entity\Visiteur $visiteur = null)
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    /**
     * Get visiteur
     *
     * @return \GSBBundle\Entity\Visiteur
     */
    public function getVisiteur()
    {
        return $this->visiteur;
    }
}
