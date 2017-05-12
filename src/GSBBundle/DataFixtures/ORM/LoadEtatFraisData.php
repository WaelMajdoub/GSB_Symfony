<?php

/**
 * Created by IntelliJ IDEA.
 * User: Davvm
 * Date: 12/05/2017
 * Time: 14:29
 */
namespace GSBBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GSBBundle\Entity\EtatFrais;

class LoadEtatFraisData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $etatFraisEnrengistre = new EtatFrais();
        $etatFraisEnrengistre->setLibelle('Enrengistré');
        $manager->persist($etatFraisEnrengistre);


        $etatFraisValide = new EtatFrais();
        $etatFraisValide->setLibelle('Validé');
        $manager->persist($etatFraisValide);


        $etatFraisRembourse = new EtatFrais();
        $etatFraisRembourse->setLibelle('Remboursé');
        $manager->persist($etatFraisRembourse);

        $manager->flush();
    }
}