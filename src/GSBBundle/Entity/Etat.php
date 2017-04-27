<?php
namespace GSBBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="GSBBundle\Repository\EtatRepository")
 */
class Etat
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $libelle;

    /**
     * @var ficheFrais
     *
     * @ORM\OneToMany(targetEntity="GSBBundle\Entity\FicheFrais", mappedBy="idEtat")
     */
    private $ficheFrais;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Etat
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
        $this->fichefrais = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fichefrai
     *
     * @param \GSBBundle\Entity\FicheFrais $fichefrai
     *
     * @return Etat
     */
    public function addFichefrai(\GSBBundle\Entity\FicheFrais $fichefrai)
    {
        $this->fichefrais[] = $fichefrai;

        return $this;
    }

    /**
     * Remove fichefrai
     *
     * @param \GSBBundle\Entity\FicheFrais $fichefrai
     */
    public function removeFichefrai(\GSBBundle\Entity\FicheFrais $fichefrai)
    {
        $this->fichefrais->removeElement($fichefrai);
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
