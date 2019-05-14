<?php

namespace App\Repository;

use App\Entity\ValidationAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ValidationAnnonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValidationAnnonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValidationAnnonce[]    findAll()
 * @method ValidationAnnonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValidationAnnonceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ValidationAnnonce::class);
    }

    public function finAllValidationByUser($user)
    {
        $query = $this->_em->createQuery("SELECT a FROM App\Entity\ValidationAnnonce a JOIN a.annonce u WHERE u.users=".$user." AND a.statut_validation=0");
        $query->setMaxResults(20);
        return $query->getResult();
    }

    // /**
    //  * @return ValidationAnnonce[] Returns an array of ValidationAnnonce objects
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
    public function findOneBySomeField($value): ?ValidationAnnonce
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
