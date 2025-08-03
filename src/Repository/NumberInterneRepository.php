<?php

namespace App\Repository;

use App\Entity\NumberInterne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NumberInterne>
 *
 * @method NumberInterne|null find($id, $lockMode = null, $lockVersion = null)
 * @method NumberInterne|null findOneBy(array $criteria, array $orderBy = null)
 * @method NumberInterne[]    findAll()
 * @method NumberInterne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumberInterneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumberInterne::class);
    }

//    /**
//     * @return NumberInterne[] Returns an array of NumberInterne objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NumberInterne
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
