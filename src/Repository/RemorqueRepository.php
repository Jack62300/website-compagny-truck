<?php

namespace App\Repository;

use App\Entity\Remorque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Remorque>
 *
 * @method Remorque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remorque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remorque[]    findAll()
 * @method Remorque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemorqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Remorque::class);
    }

//    /**
//     * @return Remorque[] Returns an array of Remorque objects
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

//    public function findOneBySomeField($value): ?Remorque
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
