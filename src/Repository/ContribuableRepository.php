<?php

namespace App\Repository;

use App\Entity\Contribuable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contribuable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contribuable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contribuable[]    findAll()
 * @method Contribuable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContribuableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contribuable::class);
    }

    // /**
    //  * @return Contribuable[] Returns an array of Contribuable objects
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
    public function findOneBySomeField($value): ?Contribuable
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
