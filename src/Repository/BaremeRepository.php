<?php

namespace App\Repository;

use App\Entity\Bareme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bareme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bareme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bareme[]    findAll()
 * @method Bareme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaremeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bareme::class);
    }

    // /**
    //  * @return Bareme[] Returns an array of Bareme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bareme
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
