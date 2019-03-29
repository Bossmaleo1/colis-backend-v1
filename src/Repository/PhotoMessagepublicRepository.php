<?php

namespace App\Repository;

use App\Entity\PhotoMessagepublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PhotoMessagepublic|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoMessagepublic|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoMessagepublic[]    findAll()
 * @method PhotoMessagepublic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoMessagepublicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PhotoMessagepublic::class);
    }

    // /**
    //  * @return PhotoMessagepublic[] Returns an array of PhotoMessagepublic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PhotoMessagepublic
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
