<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class fichefrais
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mois;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbjustificatifs;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $montantvalide;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datemodif;

    /**
     * @ORM\ManyToOne(targetEntity="etat")
     * @ORM\JoinColumn(name="idetat", referencedColumnName="id")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="visiteur")
     * @ORM\JoinColumn(name="idvisiteur", referencedColumnName="id")
     */
    private $visiteur;
}