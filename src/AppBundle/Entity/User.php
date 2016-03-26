<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\UserRepository")
 * @UniqueEntity("username", message="Username already exists")
 * @UniqueEntity("email", message="E-mail already exists")
 */
class User implements UserInterface, \Serializable {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\Length(min = 5, minMessage = "Username must have at least {{ limit }} characters")
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\Length(min = 5, minMessage = "Password must have at least {{ limit }} characters")
     */
    protected $password;
    
    protected $repass;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\Email(message = "Invalid e-mail address")
     */
    protected $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;
    
    /**
     * @ORM\OneToMany(targetEntity="Dream", mappedBy="user")
     */
    protected $dreams;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    protected $comments;

    public function __construct() {
        $this->isActive = true;
    }

    public function getSalt() {
        return null;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function eraseCredentials() {
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize($serialized);
    }

    /**
     * @Assert\IsTrue(message = "All fields are required")
     */
    public function isAllFilled() {
        return !(empty($this->username) || empty($this->email) || empty($this->password) || empty($this->repass));
    }
    
    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context) {
        if($this->password !== $this->repass) {
            $context->buildViolation("Passwords don't match")
            ->atPath('password')
            ->addViolation();
        }
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }
    
    /**
     * Get username
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }
    
    /**
     * Get password
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
    
    /**
     * Get repass
     * @return string
     */
    public function getRepass() {
        return $this->repass;
    }
    
    /**
     * Set repass
     *
     * @param string $repass
     *
     * @return User
     */
    public function setRepass($repass) {
        $this->repass = $repass;
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Add dream
     *
     * @param \AppBundle\Entity\Dream $dream
     *
     * @return User
     */
    public function addDream(\AppBundle\Entity\Dream $dream) {
        $this->dreams[] = $dream;
        return $this;
    }

    /**
     * Remove dream
     *
     * @param \AppBundle\Entity\Dream $dream
     */
    public function removeDream(\AppBundle\Entity\Dream $dream) {
        $this->dreams->removeElement($dream);
    }

    /**
     * Get dreams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDreams() {
        return $this->dreams;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return User
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
