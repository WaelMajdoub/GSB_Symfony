<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;



/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\VisiteurRepository")
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="Visiteur")
 * @UniqueEntity(fields = "username", targetClass = "GSBBundle\Entity\User", message="fos_user.username.already_used")
 */
class Visiteur extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $dateEmbauche;

    /**
     * @ORM\ManyToOne(targetEntity="LigneFraisHorsForfait")
     * @ORM\JoinColumn(name="lesLigneFraisHorsForfait", referencedColumnName="id")
     */
    protected $ligneFraisHorsForfait;

    /**
     * @ORM\ManyToOne(targetEntity="LigneFraisForfait")
     * @ORM\JoinColumn(name="lesLigneFraisForfait", referencedColumnName="id")
     */
    protected $ligneFraisForfait;

    /**
     * @ORM\ManyToOne(targetEntity="FicheFrais")
     * @ORM\JoinColumn(name="lesFicheFrais", referencedColumnName="id")
     */
    protected $ficheFrais;

    /**
     * @ORM\ManyToOne(targetEntity="GSBBundle\Entity\User")
     */
    protected $user;



    /**
     * Set dateEmbauche
     *
     * @param \DateTime $dateEmbauche
     *
     * @return Visiteur
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Visiteur
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
     * @return Visiteur
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
     * @return Visiteur
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
     * @return Visiteur
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
     * @return Visiteur
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
     * Set ligneFraisHorsForfait
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $ligneFraisHorsForfait
     *
     * @return Visiteur
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
     * @return Visiteur
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
     * @return Visiteur
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
     * Set user
     *
     * @param \GSBBundle\Entity\User $user
     *
     * @return Visiteur
     */
    public function setUser(\GSBBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \GSBBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
