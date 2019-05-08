<?php

namespace App\Repository\Product;

use App\Entity\Product\Category01;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category01|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category01|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category01[]    findAll()
 * @method Category01[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Category01Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category01::class);
    }

    // /**
    //  * @return Category01[] Returns an array of Category01 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category01
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
