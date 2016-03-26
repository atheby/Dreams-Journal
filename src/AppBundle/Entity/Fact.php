<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="facts")
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\FactRepository")
 */
class Fact {
    
    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $quote;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set quote
     *
     * @param string $quote
     *
     * @return Fact
     */
    public function setQuote($quote) {
        $this->quote = $quote;
        return $this;
    }

    /**
     * Get quote
     *
     * @return string
     */
    public function getQuote() {
        return $this->quote;
    }
}
