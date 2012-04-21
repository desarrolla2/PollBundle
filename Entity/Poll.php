<?php

namespace Desarrolla2\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Desarrolla2\PollBundle\Entity\Poll
 *
 * @ORM\Table(name="polls")
 * @ORM\Entity(repositoryClass="Desarrolla2\PollBundle\Repository\PollRepository")
 */
class Poll
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
     * @var boolean $is_active
     *
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     */
    private $is_active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="PollOption", mappedBy="poll", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id", referencedColumnName="poll_id")
     */
    protected $options;

    public function __construct()
    {
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \DateTime('now');
    }

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
     * Get name (used by SSTSideboxBundle)
     * 
     * @return string
     */
    public function getName()
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
     * Set is_active
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Add options
     *
     * @param Desarrolla2\PollBundle\Entity\PollOption $optioons
     */
    public function addPollOption(\Desarrolla2\PollBundle\Entity\PollOption $optioons)
    {
        $this->options[] = $optioons;
    }

    /**
     * Get options
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get title in slug format
     * 
     * @return string
     */
    public function getSlug()
    {
        return preg_replace("#[^\d\w\-]#", '-', strtolower($this->getTitle()));
    }

}