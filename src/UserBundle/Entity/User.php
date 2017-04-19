<?php
/**
 * Created by IntelliJ IDEA.
 * User: Davvm
 * Date: 21/03/2017
 * Time: 01:04
 */
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 *
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $cp;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $ville;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $dateEmbauche;

    /**
     * @var ligneFraisHorsForfait
     * @ORM\OneToMany(targetEntity="GSBBundle\Entity\LigneFraisHorsForfait", mappedBy="idUser")
     */
    protected $ligneFraisHorsForfait;

    /**
     * @var ligneFraisForfait
     * @ORM\OneToMany(targetEntity="GSBBundle\Entity\LigneFraisForfait", mappedBy="idUser")
     */
    protected $ligneFraisForfait;

    /**
     * @var ficheFrais
     * @ORM\OneToMany(targetEntity="GSBBundle\Entity\FicheFrais", mappedBy="idUser")
     */
    protected $ficheFrais;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
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
     * Set cp
     *
     * @param string $cp
     *
     * @return User
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set dateEmbauche
     *
     * @param \DateTime $dateEmbauche
     *
     * @return User
     */
    public function setDateEmbauche($dateEmbauche)
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    /**
     * Get dateEmbauche
     *
     * @return \DateTime
     */
    public function getDateEmbauche()
    {
        return $this->dateEmbauche;
    }

    /**
     * Set ligneFraisHorsForfait
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait
     *
     * @return User
     */
    public function setLigneFraisHorsForfait(\GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait = null)
    {
        $this->ligneFraisHorsForfait = $ligneFraisHorsForfait;

        return $this;
    }

    /**
     * Get ligneFraisHorsForfait
     *
     * @return \GSBBundle\Entity\LigneFraisHorsForfait
     */
    public function getLigneFraisHorsForfait()
    {
        return $this->ligneFraisHorsForfait;
    }

    /**
     * Set ligneFraisForfait
     *
     * @param \GSBBundle\Entity\LigneFraisForfait $ligneFraisForfait
     *
     * @return User
     */
    public function setLigneFraisForfait(\GSBBundle\Entity\LigneFraisForfait $ligneFraisForfait = null)
    {
        $this->ligneFraisForfait = $ligneFraisForfait;

        return $this;
    }

    /**
     * Get ligneFraisForfait
     *
     * @return \GSBBundle\Entity\LigneFraisForfait
     */
    public function getLigneFraisForfait()
    {
        return $this->ligneFraisForfait;
    }

    /**
     * Set ficheFrais
     *
     * @param \GSBBundle\Entity\FicheFrais $ficheFrais
     *
     * @return User
     */
    public function setFicheFrais(\GSBBundle\Entity\FicheFrais $ficheFrais = null)
    {
        $this->ficheFrais = $ficheFrais;

        return $this;
    }

    /**
     * Get ficheFrais
     *
     * @return \GSBBundle\Entity\FicheFrais
     */
    public function getFicheFrais()
    {
        return $this->ficheFrais;
    }

    /**
     * Add ligneFraisHorsForfait
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait
     *
     * @return User
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
     * Add ligneFraisForfait
     *
     * @param \GSBBundle\Entity\LigneFraisForfait $ligneFraisForfait
     *
     * @return User
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
     * Add ficheFrai
     *
     * @param \GSBBundle\Entity\FicheFrais $ficheFrai
     *
     * @return User
     */
    public function addFicheFrai(\GSBBundle\Entity\FicheFrais $ficheFrai)
    {
        $this->ficheFrais[] = $ficheFrai;

        return $this;
    }

    /**
     * Remove ficheFrai
     *
     * @param \GSBBundle\Entity\FicheFrais $ficheFrai
     */
    public function removeFicheFrai(\GSBBundle\Entity\FicheFrais $ficheFrai)
    {
        $this->ficheFrais->removeElement($ficheFrai);
    }
}
