<?php

namespace App\Repository;

use App\Entity\Race;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Race|null find($id, $lockMode = null, $lockVersion = null)
 * @method Race|null findOneBy(array $criteria, array $orderBy = null)
 * @method Race[]    findAll()
 * @method Race[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Race::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Race $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Race $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Race[] Returns an array of Race objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Race
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */



   /**
     * @return Race[]
     */
    public function raceForType(string $tipo): array
    {
        $entityManager = $this->getEntityManager();

        $type = intval($tipo);

        $query = $entityManager->createQuery(
            "SELECT r
            FROM App\Entity\Race r
            WHERE r.type = ".$tipo
        );
        
        // returns an array of Product objects
        return $query->getResult();
    }



}
