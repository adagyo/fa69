<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class carRepository extends EntityRepository {
    public function findAllCarsOfCustomer($customerId,$search) {
        return $this->createQueryBuilder('c')
            ->join('c.customer','cust')
            ->where('c.regPlate LIKE :search')
            ->setParameter('search', $search.'%')
            ->andWhere('cust.id = :custId')
            ->setParameter('custId', $customerId)
            ->orderBy('c.regPlate', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findRegPlate($regPlate) {
        return $this->createQueryBuilder('c')
            ->where('c.regPlate LIKE :search')
            ->setParameter('search', $regPlate.'%')
            ->orderBy('c.regPlate', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
