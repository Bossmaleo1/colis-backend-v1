<?php

namespace App\Repository;

use App\Entity\Categorieprob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Categorieprob|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorieprob|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorieprob[]    findAll()
 * @method Categorieprob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieprobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Categorieprob::class);
    }

    public function SearchCatProb($search_query)
    {
        $query = $this->_em->createQuery("SELECT a FROM App\Entity\Categorieprob a  WHERE a.libelle LIKE '%".$search_query."%'");

        return $query->getResult();
    }

    public function findAllCatProb()
    {
        $query = $this->_em->createQuery('SELECT a FROM App\Entity\Categorieprob a  ORDER BY a.libelle ASC');
        $query->setMaxResults(20);

        return $query->getResult();
    }

    // /**
    //  * @return Categorieprob[] Returns an array of Categorieprob objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categorieprob
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
