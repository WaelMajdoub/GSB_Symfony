<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class lignefraisforfait
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
     * @ORM\ManyToOne(targetEntity="fraisforfait")
     * @ORM\JoinColumn(name="idfraisforfait", referencedColumnName="id")
     */
    private $fraisforfait;

    /**
     * @ORM\ManyToOne(targetEntity="visiteur")
     * @ORM\JoinColumn(name="idvisiteur", referencedColumnName="id")
     */
    private $visiteur;
}