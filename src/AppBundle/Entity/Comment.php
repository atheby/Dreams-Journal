<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\CommentRepository")
 */
class Comment {
    
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Utils\IDGenerator")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Dream", inversedBy="comments")
     */
    protected $dream;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $text;
    
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

    /**
     * Get id
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Comment
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Set addedAt
     *
     * @param \DateTime $addedAt
     *
     * @return Comment
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
     * Set dream
     *
     * @param \AppBundle\Entity\Dream $dream
     *
     * @return Comment
     */
    public function setDream(\AppBundle\Entity\Dream $dream = null) {
        $this->dream = $dream;
        return $this;
    }

    /**
     * Get dream
     *
     * @return \AppBundle\Entity\Dream
     */
    public function getDream() {
        return $this->dream;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Comment
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
}
