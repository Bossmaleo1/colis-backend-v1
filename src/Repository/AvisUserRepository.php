<?php

namespace App\Repository;

use App\Entity\AvisUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvisUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisUser[]    findAll()
 * @method AvisUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvisUser::class);
    }

    // /**
    //  * @return AvisUser[] Returns an array of AvisUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AvisUser
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
