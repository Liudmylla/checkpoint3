<?php

namespace App\Repository;

use App\Entity\Tile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tile[]    findAll()
 * @method Tile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tile::class);
    }

     /**
      * @return Tile[] Returns an array of Tile objects
      */
    
    public function findOneByCoord($x,$y): ?Tile
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.coordX = :valX')
            ->andWhere('t.coordY = :valY')
            ->setParameter('valX', $x)
            ->setParameter('valY', $y)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Tile
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
