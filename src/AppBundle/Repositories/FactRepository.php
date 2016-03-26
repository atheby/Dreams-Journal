<?php

namespace AppBundle\Repositories;

class FactRepository extends \Doctrine\ORM\EntityRepository {
    
    public function getRandomFact() {
        $facts = $this->getEntityManager()->createQuery('SELECT f FROM AppBundle:Fact f')->getResult();
        return $facts[mt_rand(0, count($facts) - 1)];
    }
}
