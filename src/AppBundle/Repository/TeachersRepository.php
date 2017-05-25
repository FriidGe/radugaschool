<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TeachersRepository extends EntityRepository
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

    public function findOneById($id)
    {
        return $this->createQueryBuilder("p")
            ->select("p.id, p.fullName,s.id as school,sub.id as post")
            ->innerJoin('AppBundle:Schools', 's', 'WITH', 'p.school = s.id')
            ->innerJoin('AppBundle:Subjects', 'sub', 'WITH', 'p.post = sub.id')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
}