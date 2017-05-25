<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PupilsRepository extends EntityRepository
{
    public function findOneByEmailAndPassword($email, $password)
    {
       return $this->createQueryBuilder("p")
           ->select("p.id, p.fullName")
           ->where('p.email = :email and p.password = :password')
           ->setParameter('email', $email)
           ->setParameter('password', $password)
           ->setMaxResults(1)
           ->getQuery()
           ->getResult();
    }

    public function findByProgress($id, $firstDay, $lastDay){
        $query = $this->createQueryBuilder('p')
            ->select('pr.mark, s.name, pr.date, pr.note')
            ->leftJoin('AppBundle:Progress', 'pr', 'WITH', 'p.id = pr.pupil')
            ->leftJoin('AppBundle:Subjects', 's', 'WITH', 's.id = pr.subject')
            ->where('p.id = :id AND pr.date BETWEEN :monday AND :sunday')
            ->setParameter('id', $id)
            ->setParameter('monday', $firstDay)
            ->setParameter('sunday', $lastDay)
            ->getQuery();

        return $query->getResult();
    }

    public function findByPhone($id){
        return $this->createQueryBuilder('p')
            ->select('pr.email')
            ->innerJoin('AppBundle:Parents', 'pr', 'WITH', 'p.parents = pr.id')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function findByNewClass($id)
    {
        return $this->createQueryBuilder("p")
            ->select("c.id, c.number,c.letter")
            ->innerJoin('AppBundle:Userclass', 'c', 'WITH', 'c.id = p.class')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    public function findByClass($schoolId, $number, $letter)
    {
        return $this->createQueryBuilder("p")
        ->select("p.id, p.fullName")
        ->innerJoin('AppBundle:Userclass', 'c', 'WITH', 'c.id = p.class')
        ->innerJoin('AppBundle:Schools', 's', 'WITH', 'c.school = s.id')
        ->where('s.id = :schoolId and c.number = :number and c.letter = :letter')
        ->setParameter('schoolId', $schoolId)
        ->setParameter('number', $number)
        ->setParameter('letter', $letter)
        ->getQuery()
        ->getResult();
    }
}