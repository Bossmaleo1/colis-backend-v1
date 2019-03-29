<?php

namespace App\Repository;

use App\Entity\Problematique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Problematique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Problematique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Problematique[]    findAll()
 * @method Problematique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblematiqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Problematique::class);
    }

    public function SearchCatProb($search_query,$id)
    {
        $query = $this->_em->createQuery("SELECT a FROM App\Entity\Problematique a JOIN a.categorieprob u WHERE a.libelle LIKE '%".$search_query."%' AND u.id= :id");
        $query->setParameter('id',$id);
        /*$query = $this->_em->createQuery("SELECT a FROM App\Entity\Categorieprob a  WHERE a.libelle LIKE '%".$search_query."%'");*/
        return $query->getResult();
    }

    public function findProblematique($id)
    {
         $query = $this->_em->createQuery('SELECT a FROM App\Entity\Problematique a JOIN a.categorieprob u WHERE u.id= :id');
         $query->setParameter('id',$id);
         //$query->setMaxResults($pagination);
         return $query->getResult();
    }

    // /**
    //  * @return Problematique[] Returns an array of Problematique objects
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
    public function findOneBySomeField($value): ?Problematique
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
