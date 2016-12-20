<?php

namespace Veta\HomeworkBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Veta\HomeworkBundle\Entity\Post;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setTitle("Lanvin parfum 2016");
        $post->setTheme($this->getReference('theme_id'));
        $post->setDiscription('SO CUTE. For a bubbly and delicate woman.');
        $post->setText('For a bubbly and delicate woman. So Cute is an adorable character that radiates life through her colorful features. La coquette once again makes you smile with her sweetly expressive pout. She is simply a charmingly mischievous cutie peeping out from under an enormous neon-pink grosgrain bow. She is both quirky and sophisticated.');
        $post->setUserAdmin($this->getReference('user_admin_id'));
        $post->setStatus(true);
        $post->setDateCreate(new \DateTime());

        $manager->persist($post);
        $manager->flush();

        $this->addReference('post_id', $post);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }
}
