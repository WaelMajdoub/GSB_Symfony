<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
}
