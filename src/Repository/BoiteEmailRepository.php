<?php

namespace App\Repository;

use App\Entity\BoiteEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BoiteEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoiteEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoiteEmail[]    findAll()
 * @method BoiteEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoiteEmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoiteEmail::class);
    }

    // /**
    //  * @return BoiteEmail[] Returns an array of BoiteEmail objects
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
    public function findOneBySomeField($value): ?BoiteEmail
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
