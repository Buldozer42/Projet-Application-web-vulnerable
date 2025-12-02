<?php

namespace App\Repository;

use App\Entity\Atelie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Atelie>
 *
 * @method Atelie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Atelie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Atelie[]    findAll()
 * @method Atelie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtelieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atelie::class);
    }

//    /**
//     * @return Atelie[] Returns an array of Atelie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Atelie
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
