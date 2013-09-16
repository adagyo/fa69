<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * vat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Adagyo\FA69Bundle\Entity\vatRepository")
 */
class vat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float")
     */
    private $rate;

    /**
     * @var isCurrent
     * @ORM\Column(name="isCurrent", type="boolean")
     */
    private $isCurrent;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set rate
     *
     * @param float $rate
     * @return vat
     */
    public function setRate($rate) {
        $this->rate = $rate;
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate() {
        return $this->rate;
    }

    /**
     * Set isCurrent
     *
     * @param boolean $isCurrent
     * @return vat
     */
    public function setIsCurrent($isCurrent) {
        $this->isCurrent = $isCurrent;
        return $this;
    }

    /**
     * Get isCurrent
     *
     * @return boolean 
     */
    public function getIsCurrent() {
        return $this->isCurrent;
    }
}