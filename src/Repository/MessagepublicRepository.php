<?php

namespace App\Repository;

use App\Entity\Messagepublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Messagepublic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messagepublic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messagepublic[]    findAll()
 * @method Messagepublic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagepublicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Messagepublic::class);
    }

    // /**
    //  * @return Messagepublic[] Returns an array of Messagepublic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Messagepublic
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
