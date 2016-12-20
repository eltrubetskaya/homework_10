<?php

namespace Veta\HomeworkBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;
use Doctrine\ORM\Mapping as ORM;
use Veta\HomeworkBundle\Entity\Post;

/**
 * Tag
 *
 * @ORM\Entity(repositoryClass="Veta\HomeworkBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @SymfonyConstraints\NotBlank(
     *     message="This value should not be blank."
     * )
     * @SymfonyConstraints\NotNull(
     *     message="This value should not be null."
     * )
     * @SymfonyConstraints\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @SymfonyConstraints\Length(
     *     min="3",
     *     max="20"
     * )
     */
    private $title;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Veta\HomeworkBundle\Entity\Post", mappedBy="tags")
     * @JoinTable(name="posts_tags")
     * @SymfonyConstraints\Valid()
     */
    private $posts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tag
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add post
     *
     * @param Post $post
     *
     * @return Tag
     */
    public function addPost(Post $post)
    {
        $post->addTag($this);
        $this->posts[] = $post;
    }

    /**
     * Remove post
     *
     * @param Post $post
     */
    public function removePost(Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return ArrayCollection|Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
