<?php

namespace Veta\HomeworkBundle\Entity;

use Symfony\Component\Validator\Constraints as SymfonyConstraints;
use Doctrine\ORM\Mapping as ORM;

/**
 * Privilege
 *
 * @ORM\Entity(repositoryClass="Veta\HomeworkBundle\Repository\PrivilegeRepository")
 */
class Privilege
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
     *     min="3"
     * )
     */
    private $title;



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
     * @return Privilege
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
}
