<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\FicheFraisRepository")
 */
class FicheFrais
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
    private $nbJustificatifs;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $montantValide;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateModif;

    /**
     * @var Etat
     * @ORM\ManyToOne(targetEntity="Etat", inversedBy="ficheFrais", fetch="EAGER")
     * @ORM\JoinColumn(name="idEtat", referencedColumnName="id")
     */
    private $idEtat;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="ficheFrais")
     * @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     */
    private $idUser;


    /**
     * @var LigneFraisForfait
     * @ORM\OneToOne(targetEntity="GSBBundle\Entity\LigneFraisForfait", mappedBy="idFicheFrais")
     */
    private $ligneFraisForfait;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="GSBBundle\Entity\LigneFraisHorsForfait", mappedBy="idFicheFrais")
     */
    private $ligneFraisHorsForfait;

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
     * @return FicheFrais
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
     * Set nbJustificatifs
     *
     * @param integer $nbJustificatifs
     *
     * @return FicheFrais
     */
    public function setNbJustificatifs($nbJustificatifs)
    {
        $this->nbJustificatifs = $nbJustificatifs;

        return $this;
    }

    /**
     * Get nbJustificatifs
     *
     * @return integer
     */
    public function getNbJustificatifs()
    {
        return $this->nbJustificatifs;
    }

    /**
     * Set montantValide
     *
     * @param string $montantValide
     *
     * @return FicheFrais
     */
    public function setMontantValide($montantValide)
    {
        $this->montantValide = $montantValide;

        return $this;
    }

    /**
     * Get montantValide
     *
     * @return string
     */
    public function getMontantValide()
    {
        return $this->montantValide;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return FicheFrais
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set visiteur
     *
     * @param \UserBundle\Entity\User $visiteur
     *
     * @return FicheFrais
     */
    public function setVisiteur(\UserBundle\Entity\User $visiteur = null)
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    /**
     * Get visiteur
     *
     * @return \UserBundle\Entity\User
     */
    public function getVisiteur()
    {
        return $this->visiteur;
    }

    /**
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return FicheFrais
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
     * Constructor
     */
    public function __construct()
    {
        $this->ligneFraisForfait = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ligneFraisHorsForfait = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ligneFraisForfait
     *
     * @param \GSBBundle\Entity\LigneFraisForfait $ligneFraisForfait
     *
     * @return FicheFrais
     */
    public function addLigneFraisForfait(\GSBBundle\Entity\LigneFraisForfait $ligneFraisForfait)
    {
        $this->ligneFraisForfait[] = $ligneFraisForfait;

        return $this;
    }

    /**
     * Remove ligneFraisForfait
     *
     * @param \GSBBundle\Entity\LigneFraisForfait $ligneFraisForfait
     */
    public function removeLigneFraisForfait(\GSBBundle\Entity\LigneFraisForfait $ligneFraisForfait)
    {
        $this->ligneFraisForfait->removeElement($ligneFraisForfait);
    }

    /**
     * Get ligneFraisForfait
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneFraisForfait()
    {
        return $this->ligneFraisForfait;
    }

    /**
     * Add ligneFraisHorsForfait
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait
     *
     * @return FicheFrais
     */
    public function addLigneFraisHorsForfait(\GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait)
    {
        $this->ligneFraisHorsForfait[] = $ligneFraisHorsForfait;

        return $this;
    }

    /**
     * Remove ligneFraisHorsForfait
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait
     */
    public function removeLigneFraisHorsForfait(\GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait)
    {
        $this->ligneFraisHorsForfait->removeElement($ligneFraisHorsForfait);
    }

    /**
     * Get ligneFraisHorsForfait
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneFraisHorsForfait()
    {
        return $this->ligneFraisHorsForfait;
    }

    /**
     * Set idEtat
     *
     * @param \GSBBundle\Entity\Etat $idEtat
     *
     * @return FicheFrais
     */
    public function setIdEtat(\GSBBundle\Entity\Etat $idEtat = null)
    {
        $this->idEtat = $idEtat;

        return $this;
    }

    /**
     * Get idEtat
     *
     * @return \GSBBundle\Entity\Etat
     */
    public function getIdEtat()
    {
        return $this->idEtat;
    }
}
