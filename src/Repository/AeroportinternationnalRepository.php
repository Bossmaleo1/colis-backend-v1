<?php

namespace App\Repository;

use App\Entity\Aeroportinternationnal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Aeroportinternationnal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aeroportinternationnal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aeroportinternationnal[]    findAll()
 * @method Aeroportinternationnal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AeroportinternationnalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Aeroportinternationnal::class);
    }


    public function SearchTowns($search_query)
    {
        //$query = $this->_em->createQuery("SELECT a FROM App\Entity\Categorieprob a  WHERE a.libelle LIKE '%".$search_query."%'");
        $query = $this->_em->createQuery("SELECT a FROM App\Entity\Aeroportinternationnal a JOIN a.ville u WHERE u.Libelle  LIKE '%".$search_query."%' OR a.libelle LIKE '%".$search_query."%' OR a.code LIKE '%".$search_query."%' ");
        $query->setMaxResults(20);
        return $query->getResult();
    }


}
