<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\LigneFraisHorsForfaitRepository")
 */

class LigneFraisHorsForfait
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $montant;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="ligneFraisHorsForfait")
     * @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="GSBBundle\Entity\FicheFrais", inversedBy="ligneFraisHorsForfait")
     * @ORM\JoinColumn(name="idFicheFrais", referencedColumnName="id")
     */
    private $idFicheFrais;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $situation;

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
     * @return LigneFraisHorsForfait
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
     * @return LigneFraisHorsForfait
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LigneFraisHorsForfait
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return LigneFraisHorsForfait
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

    /**
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return LigneFraisHorsForfait
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
     * @return LigneFraisHorsForfait
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
     * Set situation
     *
     * @param string $situation
     *
     * @return LigneFraisHorsForfait
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * Get situation
     *
     * @return string
     */
    public function getSituation()
    {
        return $this->situation;
    }
}
