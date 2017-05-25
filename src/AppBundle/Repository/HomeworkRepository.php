<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class HomeworkRepository extends EntityRepository
{

    public function findByHomework($id, $firstDay, $lastDay){
        $query = $this->createQueryBuilder('p')
            ->select('s.name as subject, p.name, p.date')
            ->innerJoin('AppBundle:Subjects', 's', 'WITH', 's.id = p.subject')
            ->where('p.userclass = :id AND p.date BETWEEN :monday AND :sunday')
            ->setParameter('id', $id)
            ->setParameter('monday', $firstDay)
            ->setParameter('sunday', $lastDay)
            ->getQuery();

        return $query->getResult();
    }

}