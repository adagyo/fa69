<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class lineRepository extends EntityRepository {
    public function findAllByLineLabel($search) {
        return $this->createQueryBuilder('p')
            ->select('DISTINCT p.lineLabel')
            ->where('p.lineLabel LIKE :search')
                ->setParameter('search', '%'.$search.'%')
            ->orderBy('p.lineLabel', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
