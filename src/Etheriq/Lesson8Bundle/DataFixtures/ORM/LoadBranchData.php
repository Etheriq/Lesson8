<?php
/**
 * Created by PhpStorm.
 * File: LoadBranchData.php
 * User: Yuriy Tarnavskiy
 * Date: 20.11.13
 * Time: 14:34
 * To change this template use File | Settings | File Templates.
 */

namespace Etheriq\Lesson6Bundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\Doctrine;
use Symfony\Component\Yaml\Yaml;
use Etheriq\Lesson8Bundle\Entity\Guest;

class LoadBranchData extends AbstractFixture implements OrderedFixtureInterface
{
    protected  $references = array();

    public function load(ObjectManager $manager)
    {
        $dataArray = Yaml::parse(file_get_contents(__DIR__."/data/dataGuest.yml"));

        foreach ($dataArray['Guests'] as $dataGuest)
        {
            $guest = new Guest();

            $guest->setNameGuest($dataGuest['nameGuest']);
            $guest->setEmailGuest($dataGuest['emailGuest']);
            $guest->setBodyGuest($dataGuest['bodyGuest']);

            $manager->persist($guest);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
} 