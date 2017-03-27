<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\VisiteurRepository")
 * @ORM\Table(name="Visiteur")
 */

class Visiteur extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
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
    private $adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEmbauche;

    /**
     * @ORM\ManyToOne(targetEntity="LigneFraisHorsForfait")
     * @ORM\JoinColumn(name="lesLigneFraisHorsForfait", referencedColumnName="id")
     */
    private $lignefraishorsforfait;

    /**
     * @ORM\ManyToOne(targetEntity="LigneFraisForfait")
     * @ORM\JoinColumn(name="lesLigneFraisForfait", referencedColumnName="id")
     */
    private $lignefraisforfait;

    /**
     * @ORM\ManyToOne(targetEntity="FicheFrais")
     * @ORM\JoinColumn(name="lesFicheFrais", referencedColumnName="id")
     */
    private $fichefrais;


    /**
     * Visiteur constructor.
     */
    public function __construct($log, $pdw, $mail)
    {

        $this->setEmail($mail);
        $this->setPassword($pdw);
        $this->setUsername($log);
        $this->setEnabled(true);
    }


    /**
     * Get id
     *
     * @return string
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
     * Set lignefraishorsforfait
     *
     * @param \GSBBundle\Entity\LigneFraisHorsForfait $lignefraishorsforfait
     *
     * @return Visiteur
     */
    public function setLignefraishorsforfait(\GSBBundle\Entity\LigneFraisHorsForfait $lignefraishorsforfait = null)
    {
        $this->lignefraishorsforfait = $lignefraishorsforfait;

        return $this;
    }

    /**
     * Get lignefraishorsforfait
     *
     * @return \GSBBundle\Entity\LigneFraisHorsForfait
     */
    public function getLignefraishorsforfait()
    {
        return $this->lignefraishorsforfait;
    }

    /**
     * Set lignefraisforfait
     *
     * @param \GSBBundle\Entity\LigneFraisForfait $lignefraisforfait
     *
     * @return Visiteur
     */
    public function setLignefraisforfait(\GSBBundle\Entity\LigneFraisForfait $lignefraisforfait = null)
    {
        $this->lignefraisforfait = $lignefraisforfait;

        return $this;
    }

    /**
     * Get lignefraisforfait
     *
     * @return \GSBBundle\Entity\LigneFraisForfait
     */
    public function getLignefraisforfait()
    {
        return $this->lignefraisforfait;
    }

    /**
     * Set fichefrais
     *
     * @param \GSBBundle\Entity\FicheFrais $fichefrais
     *
     * @return Visiteur
     */
    public function setFichefrais(\GSBBundle\Entity\FicheFrais $fichefrais = null)
    {
        $this->fichefrais = $fichefrais;

        return $this;
    }

    /**
     * Get fichefrais
     *
     * @return \GSBBundle\Entity\FicheFrais
     */
    public function getFichefrais()
    {
        return $this->fichefrais;
    }



}
