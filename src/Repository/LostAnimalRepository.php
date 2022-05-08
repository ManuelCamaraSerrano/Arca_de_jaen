<?php

namespace App\Repository;

use App\Entity\LostAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method LostAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method LostAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method LostAnimal[]    findAll()
 * @method LostAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LostAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LostAnimal::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(LostAnimal $entity, bool $flush = true): void
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
    public function remove(LostAnimal $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return LostAnimal[] Returns an array of LostAnimal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LostAnimal
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    
    public function insertLostAnimal($array, EntityManagerInterface $entityManager){
        
        $lostAnimal= new LostAnimal();
        
        $lostAnimal->setName($array[0]);

        $lostAnimal->setColour($array[1]);

        $lostAnimal->setLat($array[2]);

        $lostAnimal->setLng($array[3]);

        $lostAnimal->setDescription($array[4]);

        $lostAnimal->setPhoto($array[5]);

        $lostAnimal->setType($array[6]);

        $lostAnimal->setRace($array[7]);

        $lostAnimal->setUsuario($array[8]);

        $entityManager->persist($lostAnimal);
        
        $entityManager->flush();
          
    }





}
