<?php

namespace App\Repository;

use App\Entity\Messageprive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Messageprive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messageprive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messageprive[]    findAll()
 * @method Messageprive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagepriveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Messageprive::class);
    }

    // /**
    //  * @return Messageprive[] Returns an array of Messageprive objects
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
    public function findOneBySomeField($value): ?Messageprive
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
