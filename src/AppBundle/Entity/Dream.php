<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\DreamRepository")
 * @ORM\Table(name="dreams")
 */
class Dream {
    
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Utils\IDGenerator")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="dreams")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="dream")
     * @ORM\OrderBy({"addedAt" = "DESC"})
     */
    protected $comments;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $location;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $tags;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $addedAt;
    
    /** 
     * @ORM\PrePersist 
     */
    public function createTimestamp() {
        $this->addedAt = date_create(date('Y-m-d H:i:s'));
    }
    
    public function __construct() {
        $this->comments = new ArrayCollection();
    }
    
    /**
     * @Assert\IsTrue(message = "All fields are required")
     */
    public function isAllFilled() {
        return !(empty($this->title) || empty($this->date) || empty($this->description));
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Dream
     */
    public function setDate($date) {
        $this->date = date_create($date);
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Dream
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
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
     * Set country
     *
     * @param string $country
     *
     * @return Dream
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Dream
     */
    public function setLocation($location) {
        $this->location = $location;
        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Dream
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return Dream
     */
    public function setTags($tags) {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set addedAt
     *
     * @param \DateTime $addedAt
     *
     * @return Dream
     */
    public function setAddedAt($addedAt) {
        $this->addedAt = $addedAt;
        return $this;
    }

    /**
     * Get addedAt
     *
     * @return \DateTime
     */
    public function getAddedAt() {
        return $this->addedAt;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Dream
     */
    public function setUser(\AppBundle\Entity\User $user = null) {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return Dream
     */
    public function addComment(\AppBundle\Entity\Comment $comment) {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comment) {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments() {
        return $this->comments;
    }
}
