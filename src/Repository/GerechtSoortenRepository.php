<?php

namespace App\Repository;

use App\Entity\GerechtSoorten;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GerechtSoorten|null find($id, $lockMode = null, $lockVersion = null)
 * @method GerechtSoorten|null findOneBy(array $criteria, array $orderBy = null)
 * @method GerechtSoorten[]    findAll()
 * @method GerechtSoorten[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GerechtSoortenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GerechtSoorten::class);
    }

    // /**
    //  * @return GerechtSoorten[] Returns an array of GerechtSoorten objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GerechtSoorten
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
