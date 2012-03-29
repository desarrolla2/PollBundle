<?php

namespace SFM\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use SFM\WebsiteBundle\Entity\PollOptionHit;

/**
 * SFM\WebsiteBundle\Entity\PollOption
 *
 * @ORM\Table(name="polls_options")
* @ORM\Entity(repositoryClass="SFM\WebsiteBundle\Repository\PollOptionRepository")
 */
class PollOption {

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
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="options")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     */
    private $poll;
    
    /**
     * @ORM\OneToMany(targetEntity="PollOptionHit", mappedBy="poll_option")
     * @ORM\JoinColumn(name="id", referencedColumnName="poll_option_id")
     */
    protected $hits;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set poll
     *
     * @param SFM\WebsiteBundle\Entity\Poll $poll
     */
    public function setPoll(\SFM\WebsiteBundle\Entity\Poll $poll) {
        $this->poll = $poll;
    }

    /**
     * Get poll
     *
     * @return SFM\WebsiteBundle\Entity\Poll 
     */
    public function getPoll() {
        return $this->poll;
    }
    
    public function __toString(){
        return $this->getTitle();
    }

    public function __construct()
    {
        $this->hits = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get hits
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Add hits
     *
     * @param SFM\WebsiteBundle\Entity\PollOptionHit $hits
     */
    public function addPollOptionHit(\SFM\WebsiteBundle\Entity\PollOptionHit $hits)
    {
        $this->hits[] = $hits;
    }
}