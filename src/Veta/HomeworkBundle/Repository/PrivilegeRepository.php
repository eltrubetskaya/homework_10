<?php

namespace Veta\HomeworkBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PrivilegeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PrivilegeRepository extends EntityRepository
{
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
