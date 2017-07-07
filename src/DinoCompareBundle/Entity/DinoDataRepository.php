<?php

namespace DinoCompareBundle\Entity;
use Doctrine\ORM\EntityRepository;

class DinoDataRepository extends EntityRepository
{
    public function findDinoByName($text)
    {
        var_dump($text);
//        $query = $this->getEntityManager()->createQueryBuilder('p')
//            ->where('p.name Like :word')
//            ->setParameter('word', '%' . $text . '%')
//            ->getQuery();
//        $dinos = $query->getResult();
//
//        return $dinos;

//        $dino = $this->getEntityManager()->createQuery(
//            'SELECT p from DinoCompareBundle:DinoData p WHERE p.name LIKE :text')
//            ->setParameter('text', $text)
//            ->getResult();
//
//        var_dump($dino);
//
//        return $dino;
    }
}