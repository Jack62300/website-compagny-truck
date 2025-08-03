<?php

namespace App\Repository;

use App\Entity\RegistreStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RegistreStatus>
 *
 * @method RegistreStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistreStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistreStatus[]    findAll()
 * @method RegistreStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistreStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistreStatus::class);
    }

//    /**
//     * @return RegistreStatus[] Returns an array of RegistreStatus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RegistreStatus
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
