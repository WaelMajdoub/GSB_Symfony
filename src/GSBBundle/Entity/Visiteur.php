<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\VisiteurRepository")
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
    protected $lignefraishorsforfait;

    /**
     * @ORM\ManyToOne(targetEntity="LigneFraisForfait")
     * @ORM\JoinColumn(name="lesLigneFraisForfait", referencedColumnName="id")
     */
    protected $lignefraisforfait;

    /**
     * @ORM\ManyToOne(targetEntity="FicheFrais")
     * @ORM\JoinColumn(name="lesFicheFrais", referencedColumnName="id")
     */
    protected $fichefrais;

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
