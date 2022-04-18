<?php

namespace App\Repository;

use App\Entity\EspacioFisico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EspacioFisico|null find($id, $lockMode = null, $lockVersion = null)
 * @method EspacioFisico|null findOneBy(array $criteria, array $orderBy = null)
 * @method EspacioFisico[]    findAll()
 * @method EspacioFisico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspacioFisicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EspacioFisico::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EspacioFisico $entity, bool $flush = true): void
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
    public function remove(EspacioFisico $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return EspacioFisico[] Returns an array of EspacioFisico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EspacioFisico
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
