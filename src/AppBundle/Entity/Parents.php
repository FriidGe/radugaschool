<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parents
 *
 * @ORM\Table(name="parents")
 * @ORM\Entity
 */
class Parents
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
     * @ORM\Column(name="dad_name", type="string", length=255, nullable=false)
     */
    private $dadName;

    /**
     * @var string
     *
     * @ORM\Column(name="mom_name", type="string", length=255, nullable=false)
     */
    private $momName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;



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
     * Set dadName
     *
     * @param string $dadName
     * @return Parents
     */
    public function setDadName($dadName)
    {
        $this->dadName = $dadName;

        return $this;
    }

    /**
     * Get dadName
     *
     * @return string 
     */
    public function getDadName()
    {
        return $this->dadName;
    }

    /**
     * Set momName
     *
     * @param string $momName
     * @return Parents
     */
    public function setMomName($momName)
    {
        $this->momName = $momName;

        return $this;
    }

    /**
     * Get momName
     *
     * @return string 
     */
    public function getMomName()
    {
        return $this->momName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Parents
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
     * @return Parents
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
}
