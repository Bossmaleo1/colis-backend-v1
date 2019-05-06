<?php

namespace App\Repository;

use App\Entity\NombreDeKiloRestant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NombreDeKiloRestant|null find($id, $lockMode = null, $lockVersion = null)
 * @method NombreDeKiloRestant|null findOneBy(array $criteria, array $orderBy = null)
 * @method NombreDeKiloRestant[]    findAll()
 * @method NombreDeKiloRestant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NombreDeKiloRestantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NombreDeKiloRestant::class);
    }

    // /**
    //  * @return NombreDeKiloRestant[] Returns an array of NombreDeKiloRestant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NombreDeKiloRestant
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
