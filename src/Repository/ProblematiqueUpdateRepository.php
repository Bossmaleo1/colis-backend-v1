<?php

namespace App\Repository;

use App\Entity\ProblematiqueUpdate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProblematiqueUpdate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProblematiqueUpdate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProblematiqueUpdate[]    findAll()
 * @method ProblematiqueUpdate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblematiqueUpdateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProblematiqueUpdate::class);
    }



    // /**
    //  * @return ProblematiqueUpdate[] Returns an array of ProblematiqueUpdate objects
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
    public function findOneBySomeField($value): ?ProblematiqueUpdate
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
