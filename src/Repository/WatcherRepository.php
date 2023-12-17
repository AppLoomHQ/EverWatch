<?php

namespace App\Repository;

use App\Entity\Watcher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Watcher>
 *
 * @method Watcher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Watcher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Watcher[]    findAll()
 * @method Watcher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatcherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Watcher::class);
    }

//    /**
//     * @return Watcher[] Returns an array of Watcher objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Watcher
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
