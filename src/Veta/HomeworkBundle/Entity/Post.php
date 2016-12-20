<?php

namespace Veta\HomeworkBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;
use Veta\HomeworkBundle\Entity\Comment;
use Veta\HomeworkBundle\Entity\Tag;
use Veta\HomeworkBundle\Entity\Theme;
use Veta\HomeworkBundle\Entity\UserAdmin;

/**
 * Post
 *
 * @ORM\Entity(repositoryClass="Veta\HomeworkBundle\Repository\PostRepository")
 */
class Post
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
     *     max="50"
     * )
     */
    private $title;

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
     *     min="3"
     * )
     */
    private $discription;

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
     * @var boolean
     *
     * @SymfonyConstraints\Type(
     *     type="boolean",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $status;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Veta\HomeworkBundle\Entity\Comment", mappedBy="post")
     * @SymfonyConstraints\Valid()
     */
    private $comments;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Veta\HomeworkBundle\Entity\Theme")
     * @SymfonyConstraints\Valid()
     */
    private $theme;

    /**
     * @var UserAdmin
     *
     * @ORM\ManyToOne(targetEntity="Veta\HomeworkBundle\Entity\UserAdmin")
     * @SymfonyConstraints\Valid()
     */
    private $userAdmin;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Veta\HomeworkBundle\Entity\Tag", inversedBy="posts")
     * @JoinTable(name="posts_tags")
     * @SymfonyConstraints\Valid()
     */
    private $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
     * @return Post
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
     * Set discription
     *
     * @param string $discription
     *
     * @return Post
     */
    public function setDiscription($discription)
    {
        $this->discription = $discription;

        return $this;
    }

    /**
     * Get discription
     *
     * @return string
     */
    public function getDiscription()
    {
        return $this->discription;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Post
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
     * @return Post
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
     * Set status
     *
     * @param boolean $status
     *
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add comment
     *
     * @param Comment $comment
     *
     * @return Post
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return  ArrayCollection|Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set theme
     *
     * @param Theme $theme
     *
     * @return Post
     */
    public function setTheme(Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set userAdmin
     *
     * @param UserAdmin $userAdmin
     *
     * @return Post
     */
    public function setUserAdmin(UserAdmin $userAdmin = null)
    {
        $this->userAdmin = $userAdmin;

        return $this;
    }

    /**
     * Get userAdmin
     *
     * @return UserAdmin
     */
    public function getUserAdmin()
    {
        return $this->userAdmin;
    }

    /**
     * Add tag
     *
     * @param Tag $tag
     *
     * @return Post
     */
    public function addTag(Tag $tag)
    {
        $tag->addPost($this);
        $this->tags[] = $tag;
    }

    /**
     * Remove tag
     *
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return ArrayCollection|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }
}
