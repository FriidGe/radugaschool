<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserClassRepository extends EntityRepository
{
    public function findAllBySchool($school)
    {
        return $this->createQueryBuilder("p")
            ->select("p.id, p.number, p.letter")
            ->innerJoin('AppBundle:Schools', 's', 'WITH', 'p.school = s.id')
            ->where('s.id = :school')
            ->setParameter('school', $school)
            ->getQuery()
            ->getResult();
    }
}