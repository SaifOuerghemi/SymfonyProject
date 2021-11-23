<?php

namespace App\Repository;

use App\Entity\FormSesSeance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormSesSeance|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormSesSeance|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormSesSeance[]    findAll()
 * @method FormSesSeance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormSesSeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormSesSeance::class);
    }

    // /**
    //  * @return FormSesSeance[] Returns an array of FormSesSeance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormSesSeance
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
