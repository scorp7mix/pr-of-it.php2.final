<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Book
 *
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $origin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $year;

    /**
     * @ORM\ManyToOne(targetEntity="Series", inversedBy="books")
     * @ORM\JoinColumn(name="series_id", referencedColumnName="id")
     */
    protected $series;

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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set origin
     *
     * @param string $origin
     *
     * @return Book
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set series
     *
     * @param \AppBundle\Entity\Series $series
     *
     * @return Book
     */
    public function setSeries(\AppBundle\Entity\Series $series = null)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return \AppBundle\Entity\Series
     */
    public function getSeries()
    {
        return $this->series;
    }
}
