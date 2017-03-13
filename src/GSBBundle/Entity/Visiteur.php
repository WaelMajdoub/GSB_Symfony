<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Visiteur
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
    private $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mdp;

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
}