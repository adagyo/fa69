<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * line
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Adagyo\FA69Bundle\Entity\lineRepository")
 */
class line
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var string
     * @ORM\Column(name="lineLabel", type="string", length=255)
     */
    private $lineLabel;

    /**
     * @var string
     * @ORM\Column(name="quality", type="string", length=255)
     */
    private $quality;

    /**
     * @var float
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

    /**
     * @var float
     * @ORM\Column(name="discount", type="float")
     */
    private $discount;

    /**
     * @var float
     * @ORM\Column(name="unitPriceVAT", type="float")
     */
    private $unitPriceVAT;

    /**
     * @ORM\ManyToOne(targetEntity="Adagyo\FA69Bundle\Entity\bill", inversedBy="lines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bill;

    /**
     * Get id
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set number
     * @param integer $number
     * @return line
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     * @return integer 
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Set lineLabel
     * @param string $lineLabel
     * @return line
     */
    public function setLineLabel($lineLabel) {
        $this->lineLabel = $lineLabel;
        return $this;
    }

    /**
     * Get lineLabel
     * @return string 
     */
    public function getLineLabel() {
        return $this->lineLabel;
    }

    /**
     * Set quality
     * @param string $quality
     * @return line
     */
    public function setQuality($quality) {
        $this->quality = $quality;
        return $this;
    }

    /**
     * Get quality
     * @return string 
     */
    public function getQuality() {
        return $this->quality;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
        return $this;
    }

    public function getDiscount() {
        return $this->discount;
    }

    /**
     * Set quantity
     * @param float $quantity
     * @return line
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get quantity
     * @return float 
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Set unitPriceVAT
     * @param float $unitPriceVAT
     * @return line
     */
    public function setUnitPriceVAT($unitPriceVAT) {
        $this->unitPriceVAT = $unitPriceVAT;
        return $this;
    }

    /**
     * Get unitPriceVAT
     * @return float 
     */
    public function getUnitPriceVAT() {
        return $this->unitPriceVAT;
    }

    /**
     * Set bill
     * @param Adagyo\FA69Bundle\Entity\bill $bill
     */
    public function setBill($bill) {
        $this->bill = $bill;
    }

    /**
     * Get bill
     * @return Sdz\BlogBundle\Entity\bill
     */
    public function getBill() {
        return $this->bill;
    }
}