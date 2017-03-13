<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class visiteur
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
    private $dateembauche;

    /**
     * @ORM\ManyToOne(targetEntity="lignefraishorsforfait")
     * @ORM\JoinColumn(name="leslignefraishorsforfait", referencedColumnName="id")
     */
    private $lignefraishorsforfait;

    /**
     * @ORM\ManyToOne(targetEntity="lignefraisforfait")
     * @ORM\JoinColumn(name="leslignefraisforfait", referencedColumnName="id")
     */
    private $lignefraisforfait;

    /**
     * @ORM\ManyToOne(targetEntity="fichefrais")
     * @ORM\JoinColumn(name="lesfichefrais", referencedColumnName="id")
     */
    private $fichefrais;
}