<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     */
    private $visiteur;
}