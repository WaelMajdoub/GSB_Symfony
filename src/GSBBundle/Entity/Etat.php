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
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $libelle;

    public function __construct($id, $lib)
    {
        $this->id = $id;
        $this->libelle = $lib;
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


}
