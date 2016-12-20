<?php

namespace Veta\HomeworkBundle\DataFixtures\ORM;

use Veta\HomeworkBundle\Entity\Info;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadInfoData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $info = new Info();
        $info->setTitle('Contacts');
        $info->setText('Contacts');

        $manager->persist($info);
        $manager->flush();
    }
}
