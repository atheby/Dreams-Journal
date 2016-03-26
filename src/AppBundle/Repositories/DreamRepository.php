<?php

namespace AppBundle\Repositories;

class DreamRepository extends \Doctrine\ORM\EntityRepository {
    
    public function findAllLatest($page) {
        $dreams = $this->findBy(array(), array('addedAt' => 'DESC'));
        return $dreams;
    }
}
