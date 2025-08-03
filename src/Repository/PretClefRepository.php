<?php

namespace App\Repository;

use App\Entity\PretClef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PretClef>
 *
 * @method PretClef|null find($id, $lockMode = null, $lockVersion = null)
 * @method PretClef|null findOneBy(array $criteria, array $orderBy = null)
 * @method PretClef[]    findAll()
 * @method PretClef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PretClefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PretClef::class);
    }

//    /**
//     * @return PretClef[] Returns an array of PretClef objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PretClef
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
