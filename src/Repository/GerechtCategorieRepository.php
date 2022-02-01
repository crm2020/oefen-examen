<?php

namespace App\Repository;

use App\Entity\GerechtCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GerechtCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method GerechtCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method GerechtCategorie[]    findAll()
 * @method GerechtCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GerechtCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GerechtCategorie::class);
    }

    // /**
    //  * @return GerechtCategorie[] Returns an array of GerechtCategorie objects
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
    public function findOneBySomeField($value): ?GerechtCategorie
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
