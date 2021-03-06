<?php

namespace App\Repository;

use App\Entity\Diary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Diary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diary[]    findAll()
 * @method Diary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diary::class);
    }

    /**
     * Get contacts by type
     *
     * @param string $Tipocontacto
     * @return Diary[]
     */
    public function findByTipocontacto(string $Tipocontacto)
    {
        /**
         * SQL
         * 
         * SELECT * FROM diary WHERE contact_type = 'personal' ORDER BY id ASC;
         * 
         * DQL Doctrine Query Language
         * 
         * SELECT * FROM App\Entity\Diary as diary WHERE diary.Tipocontacto = 'personal' ORDER BY diary.id ASC;
         */
        return $this->createQueryBuilder('diary')
            ->where('diary.Tipocontacto = :type')
            ->setParameter('type', $Tipocontacto)
            ->orderBy('diary.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Diary[] Returns an array of Diary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Diary
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
