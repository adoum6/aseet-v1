<?php

namespace App\Repository\Activity;

use App\Entity\Activity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
      * @return Event[] Returns an array of Event objects
      */
    public function findByEventDate($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.eventDate = :val')
            ->setParameter('val', $value)
            ->orderBy('e.eventDate', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Event[] Returns an array of Event objects
     */
    public function findByEventDateDesc()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.eventDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
