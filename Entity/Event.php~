<?php

namespace SFM\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use SFM\WebsiteBundle\Feeds\EventFeed;

/**
 * SFM\WebsiteBundle\Entity\Event
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="SFM\WebsiteBundle\Repository\EventRepository")
 */
class Event extends EventFeed
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\NotBlank()
     */
    private $body;

    /**
     * @var date $date
     *
     * @ORM\Column(name="datetime", type="datetime")
     * @Assert\NotBlank()
     */
    private $datetime;

    /**
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $location;

    /**
     * @var string $gmaps
     *
     * @ORM\Column(name="gmaps", type="string", length=512, nullable=true)
     * @Assert\Url()
     */
    private $gmaps;

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
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set datetime
     *
     * @param datetime $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set location
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set Google Maps
     *
     * @param string $gmaps
     */
    public function setGmaps($gmaps)
    {
        $this->gmaps = $gmaps;
    }

    /**
     * Get Google Maps
     *
     * @return string
     */
    public function getGmaps()
    {
        return $this->gmaps;
    }
}