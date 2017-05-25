<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pupils
 *
 * @ORM\Table(name="pupils", indexes={@ORM\Index(name="teachers_id", columns={"teachers_id"}), @ORM\Index(name="parents_id", columns={"parents_id"}), @ORM\Index(name="class_id", columns={"class_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PupilsRepository")
 */
class Pupils
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
     * @ORM\Column(name="full_name", type="string", length=255, nullable=false)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \Teachers
     *
     * @ORM\ManyToOne(targetEntity="Teachers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="teachers_id", referencedColumnName="id")
     * })
     */
    private $teachers;

    /**
     * @var \Parents
     *
     * @ORM\ManyToOne(targetEntity="Parents")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parents_id", referencedColumnName="id")
     * })
     */
    private $parents;

    /**
     * @var \Userclass
     *
     * @ORM\ManyToOne(targetEntity="Userclass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     * })
     */
    private $class;



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
     * Set fullName
     *
     * @param string $fullName
     * @return Pupils
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Pupils
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Pupils
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Pupils
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Pupils
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set teachers
     *
     * @param \AppBundle\Entity\Teachers $teachers
     * @return Pupils
     */
    public function setTeachers(\AppBundle\Entity\Teachers $teachers = null)
    {
        $this->teachers = $teachers;

        return $this;
    }

    /**
     * Get teachers
     *
     * @return \AppBundle\Entity\Teachers 
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * Set parents
     *
     * @param \AppBundle\Entity\Parents $parents
     * @return Pupils
     */
    public function setParents(\AppBundle\Entity\Parents $parents = null)
    {
        $this->parents = $parents;

        return $this;
    }

    /**
     * Get parents
     *
     * @return \AppBundle\Entity\Parents 
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * Set class
     *
     * @param \AppBundle\Entity\Userclass $class
     * @return Pupils
     */
    public function setClass(\AppBundle\Entity\Userclass $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \AppBundle\Entity\Userclass 
     */
    public function getClass()
    {
        return $this->class;
    }
}
