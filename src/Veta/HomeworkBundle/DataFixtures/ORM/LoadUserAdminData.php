<?php

namespace Veta\HomeworkBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Veta\HomeworkBundle\Entity\UserAdmin;

class LoadUserAdminData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new UserAdmin();
        $userAdmin->setLogin('admin');
        $userAdmin->setStatus(true);
        $userAdmin->setNickName('AdminTest');
        $userAdmin->setPass(md5(uniqid('test')));
        $userAdmin->setPrivilege($this->getReference('privilege_id'));

        $manager->persist($userAdmin);
        $manager->flush();

        $this->addReference('user_admin_id', $userAdmin);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 4;
    }
}
