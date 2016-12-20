<?php

namespace Veta\HomeworkBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email)
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)

        ;
        $query = $qb->getQuery();

        return $query->execute();
    }

    /**
     * @return mixed
     */
    public function findOrderedById()
    {
        $qb = $this->createQueryBuilder('u')
            ->orderBy('u.id', 'ASC')

        ;
        $query = $qb->getQuery();

        return $query->execute();
    }
}