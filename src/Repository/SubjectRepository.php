<?php

namespace App\Repository;

use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Subject>
 *
 * @method Subject|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subject|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subject[]    findAll()
 * @method Subject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Subject::class);
        $this->entityManager=$entityManager;
    }
    /**
     * Add a subject in database
     */
    public function addSubject(Subject $subject){
        $this->entityManager->persist($subject);
        $this->entityManager->flush();
    }
    /**
     * Update a subject in database
     */
    public function updateSubject(){
        $this->entityManager->flush();
    }
    /**
     * Delete a subject in database
     */
    public function deleteSubject(Subject $subject){
        $this->entityManager->remove($subject);
        $this->entityManager->flush();
    }

//    /**
//     * @return Subject[] Returns an array of Subject objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Subject
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
