<?php
/**
 * Created by IntelliJ IDEA.
 * User: Davvm
 * Date: 12/05/2017
 * Time: 14:57
 */

namespace GSBBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFraisForfaitData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager) {
        $filename = 'web/sql/fraisForfaits.sql';

        $sql = file_get_contents($filename);  // Read file contents
        $manager->getConnection()->exec($sql);  // Execute native SQL

        $manager->flush();
    }

    public function getOrder() {
        return 4;  // Order in which this fixture will be executed
    }
}