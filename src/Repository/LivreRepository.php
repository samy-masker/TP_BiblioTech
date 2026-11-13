<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    public function findGenres(): array
    {
        $result = $this->createQueryBuilder('l')
            ->select('DISTINCT l.genre')
            ->orderBy('l.genre', 'ASC')
            ->getQuery()
            ->getResult();

        return array_column($result, 'genre');
    }

    public function findAuteurs(): array
    {
        $result = $this->createQueryBuilder('l')
            ->select('DISTINCT l.auteur')
            ->orderBy('l.auteur', 'ASC')
            ->getQuery()
            ->getResult();

        return array_column($result, 'auteur');
    }

    public function findCatalogue(?string $genre, ?string $auteur, ?string $tri): array
    {
        $qb = $this->createQueryBuilder('l');

        if ($genre) {
            $qb->andWhere('l.genre = :genre')
            ->setParameter('genre', $genre);
        }

        if ($auteur) {
            $qb->andWhere('l.auteur = :auteur')
            ->setParameter('auteur', $auteur);
        }

        if ($tri === 'annee_desc') {
            $qb->orderBy('l.annee', 'DESC');
        } elseif ($tri === 'annee_asc') {
            $qb->orderBy('l.annee', 'ASC');
        } else {
            $qb->orderBy('l.titre', 'ASC');
        }

        return $qb->getQuery()->getResult();
    }

    public function findPlusEmpruntes(int $limite): array
    {
        return $this->createQueryBuilder('l')
            ->select('l, COUNT(e.id) AS HIDDEN nb')
            ->leftJoin('l.emprunts', 'e')
            ->groupBy('l.id')
            ->orderBy('nb', 'DESC')
            ->setMaxResults($limite)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Livre[] Returns an array of Livre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Livre
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
