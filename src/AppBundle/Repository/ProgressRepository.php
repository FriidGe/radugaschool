<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProgressRepository extends EntityRepository
{
    public function findByProgress($school, $pupil, $subject)
    {
        return $this->createQueryBuilder("p")
            ->select("p.id, p.mark,p.date,sub.name, p.note")
            ->innerJoin('AppBundle:Pupils', 'pup', 'WITH', 'p.pupil = pup.id')
            ->innerJoin('AppBundle:Userclass', 'u', 'WITH', 'u.id = pup.class')
            ->innerJoin('AppBundle:Schools', 's', 'WITH', 'u.school = s.id')
            ->innerJoin('AppBundle:Subjects', 'sub', 'WITH', 'p.subject = sub.id')
            ->where('s.id = :school and pup.id = :pupil and sub.id = :subject')
            ->setParameter('school', $school)
            ->setParameter('pupil', $pupil)
            ->setParameter('subject', $subject)
            ->getQuery()
            ->getResult();
    }

    public function findByTeacherSchedule($id, $subject ,$firstDay, $lastDay)
    {
        $query = $this->createQueryBuilder('c')
            ->select('c.date,s.name, c.mark')
            ->innerJoin('AppBundle:Pupils', 'p', 'WITH', 'p.id = c.pupil')
            ->innerJoin('AppBundle:Subjects', 's', 'WITH', 's.id = c.subject')
            ->where('p.id = :id  AND c.date BETWEEN :monday AND :sunday')
            ->setParameter('id', $id)
            ->setParameter('monday', $firstDay)
            ->setParameter('sunday', $lastDay)
            ->getQuery();

        return $query->getResult();
    }
}