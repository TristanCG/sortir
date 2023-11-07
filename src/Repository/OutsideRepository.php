<?php

namespace App\Repository;

use App\Entity\Outside;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Outside>
 *
 * @method Outside|null find($id, $lockMode = null, $lockVersion = null)
 * @method Outside|null findOneBy(array $criteria, array $orderBy = null)
 * @method Outside[]    findAll()
 * @method Outside[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OutsideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Outside::class);
    }

//    /**
//     * @return Outside[] Returns an array of Outside objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Outside
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
