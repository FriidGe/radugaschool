<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Progress
 *
 * @ORM\Table(name="progress", indexes={@ORM\Index(name="subject_id", columns={"subject_id"}), @ORM\Index(name="pupil_id", columns={"pupil_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgressRepository")
 */
class Progress
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="mark", type="string", length=255, nullable=true)
     */
    private $mark;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @var \Pupils
     *
     * @ORM\ManyToOne(targetEntity="Pupils")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pupil_id", referencedColumnName="id")
     * })
     */
    private $pupil;

    /**
     * @var \Subjects
     *
     * @ORM\ManyToOne(targetEntity="Subjects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     * })
     */
    private $subject;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Progress
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     * @return Progress
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set pupil
     *
     * @param \AppBundle\Entity\Pupils $pupil
     * @return Progress
     */
    public function setPupil(\AppBundle\Entity\Pupils $pupil = null)
    {
        $this->pupil = $pupil;

        return $this;
    }

    /**
     * Get pupil
     *
     * @return \AppBundle\Entity\Pupils 
     */
    public function getPupil()
    {
        return $this->pupil;
    }

    /**
     * Set subject
     *
     * @param \AppBundle\Entity\Subjects $subject
     * @return Progress
     */
    public function setSubject(\AppBundle\Entity\Subjects $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \AppBundle\Entity\Subjects 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Progress
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }
}
