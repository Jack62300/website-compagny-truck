<?php

namespace App\Repository;

use App\Entity\RegistreComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RegistreComment>
 *
 * @method RegistreComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistreComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistreComment[]    findAll()
 * @method RegistreComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistreCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistreComment::class);
    }

//    /**
//     * @return RegistreComment[] Returns an array of RegistreComment objects
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

//    public function findOneBySomeField($value): ?RegistreComment
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
