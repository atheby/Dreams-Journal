<?php

namespace AppBundle\Utils;

use Doctrine\ORM\Id\AbstractIdGenerator;

class IDGenerator extends AbstractIdGenerator {
    
    public function generate(\Doctrine\ORM\EntityManager $em, $entity) {
        
        $entity_name = $em->getClassMetadata(get_class($entity))->getName();
        
        while (true) {
            $id = md5(uniqid(rand(), true));
            $item = $em->find($entity_name, $id);
            
            if (!$item) {
                return $id;
            }
        }
        throw new \Exception('Unknown problem');
    }
}