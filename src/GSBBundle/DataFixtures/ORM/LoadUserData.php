<?php
/**
 * Created by IntelliJ IDEA.
 * User: Davvm
 * Date: 12/05/2017
 * Time: 14:37
 */

namespace GSBBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData qui va charger toutes les données sql en DB
 * @package GSBBundle\DataFixtures\ORM
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Méthode qui charge les données en DB
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $filename = 'web/sql/users.sql';

        $sql = file_get_contents($filename);  // Read file contents
        $manager->getConnection()->exec($sql);  // Execute native SQL

        $manager->flush();
    }

    /**
     * Méthode qui fixe l'ordre de priorités aux insert
     * @return int
     */
    public function getOrder() {
        return 2;  // Order in which this fixture will be executed
    }
}