<?php

namespace App\Repository;

use App\Entity\QuestTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestTag[]    findAll()
 * @method QuestTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestTag::class);
    }

    // /**
    //  * @return QuestTag[] Returns an array of QuestTag objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestTag
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
