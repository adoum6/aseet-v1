<?php

namespace App\Repository\Mailer;

use App\Entity\Mailer\Preinscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Preinscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preinscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preinscription[]    findAll()
 * @method Preinscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreinscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Preinscription::class);
    }

    // /**
    //  * @return Preinscription[] Returns an array of Preinscription objects
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
    public function findOneBySomeField($value): ?Preinscription
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
