<?php

namespace App\Repository;

use App\Entity\VilleAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VilleAnnonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method VilleAnnonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method VilleAnnonce[]    findAll()
 * @method VilleAnnonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleAnnonceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VilleAnnonce::class);
    }

    // /**
    //  * @return VilleAnnonce[] Returns an array of VilleAnnonce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VilleAnnonce
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
