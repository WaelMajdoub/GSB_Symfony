<?php
/**
 * Created by IntelliJ IDEA.
 * User: Davvm
 * Date: 12/05/2017
 * Time: 14:58
 */
namespace GSBBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadLigneFraisForfaitData qui va charger toutes les données sql en DB
 * @package GSBBundle\DataFixtures\ORM
 */
class LoadLigneFraisForfaitData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Méthode qui charge les données en DB
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $filename = 'web/sql/lignesFraisForfait.sql';

        $sql = file_get_contents($filename);  // Read file contents
        $manager->getConnection()->exec($sql);  // Execute native SQL

        $manager->flush();
    }

    /**
     * Méthode qui fixe l'ordre de priorités aux insert
     * @return int
     */
    public function getOrder() {
        return 5;  // Order in which this fixture will be executed
    }
}