<?php

namespace DinoCompareBundle\Entity;
use Doctrine\ORM\EntityRepository;

class DinoDataRepository extends EntityRepository
{
    public function findDinoByName($text)
    {
        $dino = $this->getEntityManager()->createQuery(
            'SELECT p from DinoCompareBundle:DinoData p WHERE p.name LIKE :text')
            ->setParameter('text', '%' . $text . '%')
            ->getResult();
        
        return $dino;
    }
}