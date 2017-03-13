<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class FicheFrais
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
     * @ORM\ManyToOne(targetEntity="Etat")
     * @ORM\JoinColumn(name="idEtat", referencedColumnName="id")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     */
    private $visiteur;
}