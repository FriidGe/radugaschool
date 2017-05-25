<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homework
 *
 * @ORM\Table(name="homework", indexes={@ORM\Index(name="subject", columns={"subject"}), @ORM\Index(name="teacher", columns={"teacher"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HomeworkRepository")
 */
class Homework
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \Teachers
     *
     * @ORM\ManyToOne(targetEntity="Teachers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="teacher", referencedColumnName="id")
     * })
     */
    private $teacher;

    /**
     * @var \Subjects
     *
     * @ORM\ManyToOne(targetEntity="Subjects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subject", referencedColumnName="id")
     * })
     */
    private $subject;


    /**
     * @var \Userclass
     *
     * @ORM\ManyToOne(targetEntity="Userclass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userclass", referencedColumnName="id")
     * })
     */
    private $userclass;



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
     * Set name
     *
     * @param string $name
     * @return Homework
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Homework
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
     * Set teacher
     *
     * @param \AppBundle\Entity\Teachers $teacher
     * @return Homework
     */
    public function setTeacher(\AppBundle\Entity\Teachers $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \AppBundle\Entity\Teachers 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set subject
     *
     * @param \AppBundle\Entity\Subjects $subject
     * @return Homework
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
     * Set userclass
     *
     * @param \AppBundle\Entity\Userclass $userclass
     * @return Homework
     */
    public function setUserclass(\AppBundle\Entity\Userclass $userclass = null)
    {
        $this->userclass = $userclass;

        return $this;
    }

    /**
     * Get userclass
     *
     * @return \AppBundle\Entity\Userclass 
     */
    public function getUserclass()
    {
        return $this->userclass;
    }
}
