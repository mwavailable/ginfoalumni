<?php

namespace App\Repository;

use App\Entity\InternshipOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method InternshipOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternshipOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternshipOffer[]    findAll()
 * @method InternshipOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternshipOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternshipOffer::class);
    }

    // /**
    //  * @return InternshipOffer[] Returns an array of InternshipOffer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InternshipOffer
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
