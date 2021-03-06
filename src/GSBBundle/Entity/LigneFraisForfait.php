<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\LigneFraisForfaitRepository")
 */

class LigneFraisForfait
{
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $mois;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var FraisForfait
     * @ORM\ManyToOne(targetEntity="FraisForfait")
     * @ORM\JoinColumn(name="idFraisForfait", referencedColumnName="id")
     *
     */
    private $idFraisForfait;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="ligneFraisForfait")
     * @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @var FicheFrais
     * @ORM\OneToOne(targetEntity="GSBBundle\Entity\FicheFrais", inversedBy="ligneFraisForfait")
     * @ORM\JoinColumn(name="idFicheFrais", referencedColumnName="id")
     */

    private $idFicheFrais;

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
     * Set fraisForfait
     *
     * @param \GSBBundle\Entity\FraisForfait $fraisForfait
     *
     * @return LigneFraisForfait
     */
    public function setFraisForfait(\GSBBundle\Entity\FraisForfait $fraisForfait = null)
    {
        $this->fraisForfait = $fraisForfait;

        return $this;
    }

    /**
     * Get fraisForfait
     *
     * @return \GSBBundle\Entity\FraisForfait
     */
    public function getFraisForfait()
    {
        return $this->fraisForfait;
    }

    /**
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return LigneFraisForfait
     */
    public function setIdUser(\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idFicheFrais
     *
     * @param \GSBBundle\Entity\FicheFrais $idFicheFrais
     *
     * @return LigneFraisForfait
     */
    public function setIdFicheFrais(\GSBBundle\Entity\FicheFrais $idFicheFrais = null)
    {
        $this->idFicheFrais = $idFicheFrais;

        return $this;
    }

    /**
     * Get idFicheFrais
     *
     * @return \GSBBundle\Entity\FicheFrais
     */
    public function getIdFicheFrais()
    {
        return $this->idFicheFrais;
    }

    /**
     * Set idFraisForfait
     *
     * @param \GSBBundle\Entity\FraisForfait $idFraisForfait
     *
     * @return LigneFraisForfait
     */
    public function setIdFraisForfait(\GSBBundle\Entity\FraisForfait $idFraisForfait = null)
    {
        $this->idFraisForfait = $idFraisForfait;

        return $this;
    }

    /**
     * Get idFraisForfait
     *
     * @return \GSBBundle\Entity\FraisForfait
     */
    public function getIdFraisForfait()
    {
        return $this->idFraisForfait;
    }
}
