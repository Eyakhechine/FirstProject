<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function ShowAllStudentsBynsc()
    {
        return $this->createQueryBuilder('s')
            ->where('s.nsc LIKE :nsc')
            ->andWhere('s.email LIKE :email')
            ->setParameter('nsc', '0%')
            ->setParameter('email', 'test@gmail.com%')
            ->getQuery()
            ->getResult();
            
        ;
    }

public function ListStudentByClass($id){
return $this->createQueryBuilder('s')
->join('s.classroom','c')
->addSelect('c')
->where('c.id=:id')
->setParameter('id',$id)
->getQuery()
->getResult();


}


public function findStudentByEmail(){
    $entityManager=$this->getEntityManager();
    $query=$entityManager->createQuery('select p FROM App\Entity\Student p ORDER BY p.email DESC' );
    return $query->getResult();
    
        }


    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
