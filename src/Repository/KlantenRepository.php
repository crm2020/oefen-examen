<?php

namespace App\Repository;

use App\Entity\Klanten;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Klanten|null find($id, $lockMode = null, $lockVersion = null)
 * @method Klanten|null findOneBy(array $criteria, array $orderBy = null)
 * @method Klanten[]    findAll()
 * @method Klanten[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlantenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Klanten::class);
    }

    // /**
    //  * @return Klanten[] Returns an array of Klanten objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Klanten
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
