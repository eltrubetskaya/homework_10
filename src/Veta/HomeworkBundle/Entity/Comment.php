<?php

namespace Veta\HomeworkBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Veta\HomeworkBundle\Entity\Post;
use Veta\HomeworkBundle\Entity\User;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

/**
 * Comment
 *
 * @ORM\Entity(repositoryClass="Veta\HomeworkBundle\Repository\CommentRepository")
 */
class Comment
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
     * @SymfonyConstraints\Length(
     *     min="3",
     * )
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @SymfonyConstraints\DateTime(
     *     message="This value is not a valid datetime.",
     *     format="Y-m-d H:i:s"
     * )
     */
    private $dateCreate;

    /**
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="Veta\HomeworkBundle\Entity\Post", inversedBy="comments")
     * @SymfonyConstraints\Valid()
     */
    private $post;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Veta\HomeworkBundle\Entity\User")
     * @SymfonyConstraints\Valid()
     */
    private $user;



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
     * Set text
     *
     * @param string $text
     *
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Comment
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set post
     *
     * @param Post $post
     *
     * @return Comment
     */
    public function setPost(Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Comment
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
