<?php

namespace App\Repository;

use App\Entity\Request;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Request|null find($id, $lockMode = null, $lockVersion = null)
 * @method Request|null findOneBy(array $criteria, array $orderBy = null)
 * @method Request[]    findAll()
 * @method Request[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Request::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Request $entity, bool $flush = true): void
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
    public function remove(Request $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function insertRequest($array, EntityManagerInterface $entityManager){  // Función para insertar una solicitud

        $fecha = new DateTime($array[3]);
        
        $request= new Request();
        
        $request->setUsuario($array[0]);

        $request->setAnimal($array[1]);

        $request->setDescription($array[2]);

        $request->setDate($fecha);

        $entityManager->persist($request);
        
        $entityManager->flush();
          
    }

}
