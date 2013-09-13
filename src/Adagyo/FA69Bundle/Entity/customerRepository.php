<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class customerRepository extends EntityRepository {
    public function findCustomer($field,$search) {
        return $this->createQueryBuilder('c')
            ->where("c.$field LIKE :search")
            ->setParameter('search', '%'.$search.'%')
            ->orderBy("c.$field",'ASC')
            ->getQuery()
            ->getResult();
    }
}
