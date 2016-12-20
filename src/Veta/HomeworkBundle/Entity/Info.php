<?php

namespace Veta\HomeworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

/**
 * Info
 *
 * @ORM\Entity(repositoryClass="Veta\HomeworkBundle\Repository\InfoRepository")
 */
class Info
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
     * @SymfonyConstraints\Length(
     *     min="3",
     * )
     */
    private $text;

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
     * @return Info
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
     * Set text
     *
     * @param string $text
     *
     * @return Info
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
}
