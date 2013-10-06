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

    public function findCustomerByName($name,$offset,$limit) {
        return $this->createQueryBuilder('c')
            ->where('c.lastname LIKE :search')
            ->setParameter('search',$name)
            ->orderBy('c.lastname')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
