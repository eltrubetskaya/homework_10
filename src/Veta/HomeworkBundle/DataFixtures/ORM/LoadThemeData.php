<?php

namespace Veta\HomeworkBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Veta\HomeworkBundle\Entity\Theme;

class LoadThemeData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $theme = new Theme();
        $theme->setTitle('Perfume');
        $theme->setStatus(true);

        $manager->persist($theme);
        $manager->flush();

        $this->addReference('theme_id', $theme);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
