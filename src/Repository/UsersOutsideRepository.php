<?php

namespace App\Repository;

use App\Entity\UsersOutside;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UsersOutside>
 *
 * @method UsersOutside|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersOutside|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersOutside[]    findAll()
 * @method UsersOutside[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersOutsideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersOutside::class);
    }

//    /**
//     * @return UsersOutside[] Returns an array of UsersOutside objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UsersOutside
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
