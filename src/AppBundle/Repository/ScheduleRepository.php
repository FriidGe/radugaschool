<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ScheduleRepository extends EntityRepository
{
    public function findBySchedule($id, $firstDay, $lastDay)
    {
        $query = $this->createQueryBuilder('c')
            ->select('c.weekday,s.name, c.priority')
            ->innerJoin('AppBundle:Pupils', 'p', 'WITH', 'p.class = c.userclass')
            ->innerJoin('AppBundle:Subjects', 's', 'WITH', 's.id = c.subjects')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    public function findBySubjects($id)
    {
        $query = $this->createQueryBuilder('c')
            ->select('s.name')
            ->innerJoin('AppBundle:Subjects', 's', 'WITH', 's.id = c.subjects')
            ->groupBy("c.subjects")
            ->where('c.userclass = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }



}

