<?php

namespace Veta\HomeworkBundle\Entity;

use Symfony\Component\Validator\Constraints as SymfonyConstraints;
use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Entity(repositoryClass="Veta\HomeworkBundle\Repository\ThemeRepository")
 */
class Theme
{
    /**
     * @var integer
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
     * @var boolean
     *
     * @SymfonyConstraints\Type(
     *     type="boolean",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $status;

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
     * @return Theme
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
     * Set status
     *
     * @param boolean $status
     *
     * @return Theme
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
}
