<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule", indexes={@ORM\Index(name="subjects_id", columns={"subjects_id"}), @ORM\Index(name="userclass_id", columns={"userclass_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScheduleRepository")
 */
class Schedule
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
     * @ORM\Column(name="weekday", type="string", length=255, nullable=false)
     */
    private $weekday;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority;

    /**
     * @var \Userclass
     *
     * @ORM\ManyToOne(targetEntity="Userclass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userclass_id", referencedColumnName="id")
     * })
     */
    private $userclass;

    /**
     * @var \Subjects
     *
     * @ORM\ManyToOne(targetEntity="Subjects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subjects_id", referencedColumnName="id")
     * })
     */
    private $subjects;


}
