<?php

namespace App\Repository;

use App\Entity\MicroPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MicroPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method MicroPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method MicroPost[]    findAll()
 * @method MicroPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicroPostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MicroPost::class);
    }


    // Returns all Posts that are written by a list of specific Users :
    public function findAllByUsers(Collection $users)
    {
        /*  p = MicroPost
            in MySql => "Select * From micro_post p"  */
        $qb = $this->createQueryBuilder('p');

        return $qb->select('p')
                ->where('p.user IN (:following)')
                /* Equivalent à :
                    "SELECT * FROM micro_post p
                     WHERE p.user_id IN (:following)"
                     => avec :following = user id's  */
                ->setParameter('following', $users)
                ->orderBy('p.time', 'DESC')
                ->getQuery() // getQuery() : returns the Query instance
                ->getResult(); // Query::getResult() : executes the Query

    }

    // /**
    //  * @return MicroPost[] Returns an array of MicroPost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MicroPost
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
