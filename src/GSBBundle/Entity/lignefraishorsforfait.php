<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class lignefraishorsforfait
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
     * @ORM\ManyToOne(targetEntity="visiteur")
     * @ORM\JoinColumn(name="idvisiteur", referencedColumnName="id")
     */
    private $visiteur;
}