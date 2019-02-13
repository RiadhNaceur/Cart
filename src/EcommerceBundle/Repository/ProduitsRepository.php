<?php

namespace EcommerceBundle\Repository;

/**
 * ProduitsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitsRepository extends \Doctrine\ORM\EntityRepository
{
    public function byCategorie($id)
    {
       $qb = $this->createQueryBuilder('u')
           ->select('u')
           ->where('u.categorie = :categorie')
           ->andWhere('u.disponible = 1')
           ->setParameter('categorie', $id)
           ->orderBy('u.id');
        return $qb->getQuery()->getResult();

    }

    public function recherche($chaine)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.nom like :chaine')
            ->andWhere('u.disponible = 1')
            ->setParameter('chaine', $chaine.'%')
            ->orderBy('u.id');
        return $qb->getQuery()->getResult();
    }

    public function findArray($array)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.id IN (:array)')
            ->setParameter('array',$array);
        return $qb->getQuery()->getResult();
    }
}
