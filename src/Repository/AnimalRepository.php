<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Animal $entity, bool $flush = true): void
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
    public function remove(Animal $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Animal[]
     */
    public function animalPaginado(int $pagina): array
    {
        $inicio = ($pagina-1) * 8;

        $fila = 8;

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT a
            FROM App\Entity\Animal a"
        )->setFirstResult($inicio)
        ->setMaxResults($fila);
        
        // returns an array of Product objects
        return $query->getResult();
    }

    /**
     * @return Animal[]
     */
    public function getAnimalsRandom(): array
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT a
            FROM App\Entity\Animal a"
        )->setMaxResults(3);
        
        // returns an array of Product objects
        return $query->getResult();

    }


}
