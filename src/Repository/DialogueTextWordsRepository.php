<?php

namespace App\Repository;

use App\Entity\DialogueTextWords;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DialogueTextWords>
 *
 * @method DialogueTextWords|null find($id, $lockMode = null, $lockVersion = null)
 * @method DialogueTextWords|null findOneBy(array $criteria, array $orderBy = null)
 * @method DialogueTextWords[]    findAll()
 * @method DialogueTextWords[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DialogueTextWordsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DialogueTextWords::class);
    }

    public function add(DialogueTextWords $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DialogueTextWords $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DialogueTextWords[] Returns an array of DialogueTextWords objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DialogueTextWords
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
