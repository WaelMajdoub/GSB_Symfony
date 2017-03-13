<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class LigneFraisForfait
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="FraisForfait")
     * @ORM\JoinColumn(name="idFraisForfait", referencedColumnName="id")
     */
    private $fraisforfait;

    /**
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     */
    private $visiteur;
}