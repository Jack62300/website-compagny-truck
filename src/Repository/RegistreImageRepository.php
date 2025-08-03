<?php

namespace App\Repository;

use App\Entity\RegistreImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RegistreImage>
 *
 * @method RegistreImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistreImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistreImage[]    findAll()
 * @method RegistreImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistreImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistreImage::class);
    }

//    /**
//     * @return RegistreImage[] Returns an array of RegistreImage objects
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

//    public function findOneBySomeField($value): ?RegistreImage
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
