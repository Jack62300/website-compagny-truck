<?php

namespace App\Repository;

use App\Entity\Lesive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lesive>
 *
 * @method Lesive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lesive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lesive[]    findAll()
 * @method Lesive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lesive::class);
    }

//    /**
//     * @return Lesive[] Returns an array of Lesive objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Lesive
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
