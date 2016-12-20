<?php

namespace Veta\HomeworkBundle\Entity;

use Symfony\Component\Validator\Constraints as SymfonyConstraints;
use Doctrine\ORM\Mapping as ORM;
use Veta\HomeworkBundle\Entity\Privilege;

/**
 * UserAdmin
 *
 * @ORM\Entity(repositoryClass="Veta\HomeworkBundle\Repository\UserAdminRepository")
 */
class UserAdmin
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
     *     max="30"
     * )
     */
    private $login;

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
     *     min="3"
     * )
     */
    private $pass;

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
     *     max="30"
     * )
     * @SymfonyConstraints\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $nickName;

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
     * @var Privilege
     *
     * @ORM\ManyToOne(targetEntity="Veta\HomeworkBundle\Entity\Privilege")
     * @SymfonyConstraints\Valid()
     */
    private $privilege;



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
     * Set login
     *
     * @param string $login
     *
     * @return UserAdmin
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return UserAdmin
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set nickName
     *
     * @param string $nickName
     *
     * @return UserAdmin
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get nickName
     *
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return UserAdmin
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
     * Set privilege
     *
     * @param Privilege $privilege
     *
     * @return UserAdmin
     */
    public function setPrivilege(Privilege $privilege = null)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get privilege
     *
     * @return Privilege
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }
}
