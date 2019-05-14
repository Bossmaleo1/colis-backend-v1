<?php

namespace App\Repository;

use App\Entity\NotificationAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NotificationAnnonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotificationAnnonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotificationAnnonce[]    findAll()
 * @method NotificationAnnonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationAnnonceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NotificationAnnonce::class);
    }


    public function finAllNotificationByUser($user)
    {
        $query = $this->_em->createQuery("SELECT a FROM App\Entity\ValidationAnnonce a JOIN a.annonce u WHERE u.users=".$user." AND a.statut_validation=0");
        $query->setMaxResults(20);
        return $query->getResult();
    }

    // /**
    //  * @return NotificationAnnonce[] Returns an array of NotificationAnnonce objects
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
    public function findOneBySomeField($value): ?NotificationAnnonce
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
