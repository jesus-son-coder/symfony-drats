<?php

namespace App\Repository\Product;

use App\Entity\Product\Post01;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post01|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post01|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post01[]    findAll()
 * @method Post01[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Post01Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post01::class);
    }

    // /**
    //  * @return Post01[] Returns an array of Post01 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Post01
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
