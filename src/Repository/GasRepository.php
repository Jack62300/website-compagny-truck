<?php

namespace App\Repository;

use App\Entity\Gas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gas>
 *
 * @method Gas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gas[]    findAll()
 * @method Gas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gas::class);
    }

//    /**
//     * @return Gas[] Returns an array of Gas objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Gas
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
