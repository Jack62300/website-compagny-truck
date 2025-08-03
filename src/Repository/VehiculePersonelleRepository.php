<?php

namespace App\Repository;

use App\Entity\VehiculePersonelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VehiculePersonelle>
 *
 * @method VehiculePersonelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehiculePersonelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehiculePersonelle[]    findAll()
 * @method VehiculePersonelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculePersonelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehiculePersonelle::class);
    }

//    /**
//     * @return VehiculePersonelle[] Returns an array of VehiculePersonelle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VehiculePersonelle
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
