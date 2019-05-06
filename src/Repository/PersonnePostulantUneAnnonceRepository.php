<?php

namespace App\Repository;

use App\Entity\PersonnePostulantUneAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PersonnePostulantUneAnnonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnePostulantUneAnnonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnePostulantUneAnnonce[]    findAll()
 * @method PersonnePostulantUneAnnonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnePostulantUneAnnonceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PersonnePostulantUneAnnonce::class);
    }

    // /**
    //  * @return PersonnePostulantUneAnnonce[] Returns an array of PersonnePostulantUneAnnonce objects
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
    public function findOneBySomeField($value): ?PersonnePostulantUneAnnonce
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
