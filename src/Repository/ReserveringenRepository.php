<?php

namespace App\Repository;

use App\Entity\Reserveringen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reserveringen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reserveringen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reserveringen[]    findAll()
 * @method Reserveringen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReserveringenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserveringen::class);
    }

    // /**
    //  * @return Reserveringen[] Returns an array of Reserveringen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reserveringen
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
