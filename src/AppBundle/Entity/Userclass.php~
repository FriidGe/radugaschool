<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userclass
 *
 * @ORM\Table(name="userclass", indexes={@ORM\Index(name="school_id", columns={"school_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserClassRepository")
 */
class Userclass
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
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="letter", type="string", length=2, nullable=false)
     */
    private $letter;

    /**
     * @var \Schools
     *
     * @ORM\ManyToOne(targetEntity="Schools")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     * })
     */
    private $school;


}
