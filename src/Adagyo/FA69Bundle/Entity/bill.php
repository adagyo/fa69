<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * bill
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Adagyo\FA69Bundle\Entity\billRepository")
 * @ORM\HasLifecycleCallbacks
 */
class bill
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var $string
     * @ORM\Column(name="settlementDate", type="string", length=20, nullable=true)
     */
    private $settlementDate;

    /**
     * @var string
     * @ORM\Column(name="paymentMethod", type="string", length=255, nullable=true)
     */
    private $paymentMethod;

    /**
     * @var float
     */
    private $totalExVATNewPart;

    /**
     * @var float
     */
    private $totalVATNewPart;

    /**
     * @var float
     */
    private $totalExVATOldPart;

    /**
     * @var float
     */
    private $totalDiscount;

    /**
     * @var float
     */
    private $VAT;

    /**
     * @var float
     * @ORM\ManyToOne(targetEntity="Adagyo\FA69Bundle\Entity\vat")
     * @ORM\JoinColumn(nullable=true)
     */
    private $vatRate;

    /**
     * @var float
     * @ORM\Column(name="totalAmount", type="float")
     */
    private $totalAmount;

    /**
     * @ORM\ManyToOne(targetEntity="Adagyo\FA69Bundle\Entity\customer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="Adagyo\FA69Bundle\Entity\car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;

    /**
     * @ORM\Column(name="carMileage", type="integer", nullable=true)
     */
    private $carMileage;

    /**
     * @ORM\OneToMany(targetEntity="Adagyo\FA69Bundle\Entity\line", mappedBy="bill")
     */
    private $lines;

    public function __construct() {
        $this->lines = new ArrayCollection();
    }

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     * @param \DateTime $date
     * @return bill
     */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set settlementDate
     * @param \DateTime $settlementDate
     * @return bill
     */
    public function setSettlementDate($settlementDate) {
        $this->settlementDate = $settlementDate;
        return $this;
    }

    /**
     * Get settlementDate
     * @return \DateTime
     */
    public function getSettlementDate() {
        return $this->settlementDate;
    }

    /**
     * Set paymentMethod
     * @param string $paymentMethod
     * @return bill
     */
    public function setPaymentMethod($paymentMethod) {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * Get paymentMethod
     * @return string
     */
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    /**
     * Set totalExVATNewPart
     * @param float $totalExVATNewPart
     * @return bill
     */
    public function setTotalExVATNewPart($totalExVATNewPart) {
        $this->totalExVATNewPart = $totalExVATNewPart;
        return $this;
    }

    /**
     * Get totalExVATNewPart
     * @return float
     */
    public function getTotalExVATNewPart() {
        return $this->totalExVATNewPart;
    }

    /**
     * Set totalVATNewPart
     * @param float $totalVATNewPart
     * @return bill
     */
    public function setTotalVATNewPart($totalVATNewPart) {
        $this->totalVATNewPart = $totalVATNewPart;
        return $this;
    }

    /**
     * Get totalVATNewPart
     * @return float
     */
    public function getTotalVATNewPart() {
        return $this->totalVATNewPart;
    }

    /**
     * Set totalExVATOldPart
     * @param float $totalExVATOldPart
     * @return bill
     */
    public function setTotalExVATOldPart($totalExVATOldPart) {
        $this->totalExVATOldPart = $totalExVATOldPart;
        return $this;
    }

    /**
     * Get totalExVATOldPart
     * @return float
     */
    public function getTotalExVATOldPart() {
        return $this->totalExVATOldPart;
    }

    /**
     * Set totalDiscount
     * @param float $totalDiscount
     * @return bill
     */
    public function setTotalDiscount($totalDiscount) {
        $this->totalDiscount = $totalDiscount;
        return $this;
    }

    /**
     * Get totalDiscount
     * @return float
     */
    public function getTotalDiscount() {
        return $this->totalDiscount;
    }

    /**
     * Set VAT
     * @param float $VAT
     * @return bill
     */
    public function setVAT($VAT) {
        $this->VAT = $VAT;
        return $this;
    }

    /**
     * Get VAT
     * @return float
     */
    public function getVAT() {
        return $this->VAT;
    }

    /**
     * Set totalAmount
     * @param float $totalAmount
     * @return bill
     */
    public function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * Get totalAmount
     * @return float
     */
    public function getTotalAmount() {
        return $this->totalAmount;
    }

    /**
     * Set customer
     * @param Adagyo\FA69Bundle\Entity\customer $customer
     */
    public function setCustomer($customer) {
        $this->customer = $customer;
    }

    /**
     * Get customer
     * @return Adagyo\FA69Bundle\Entity\customer
     */
    public function getCustomer() {
        return $this->customer;
    }

    /**
     * Set car
     * @param Adagyo\FA69Bundle\Entity\car $car
     */
    public function setCar($car) {
        $this->car = $car;
    }

    /**
     * Get car
     * @return Adagyo\FA69Bundle\Entity\car
     */
    public function getCar() {
        return $this->car;
    }

    public function addLine(\Adagyo\FA69Bundle\Entity\line $line) {
        $this->lines[] = $line;
        $line->setBill($this);
        return $this;
    }

    public function removeLine($line) {
        $this->lines->removeElement($line);
    }

    public function getLines() {
        return $this->lines;
    }

    /**
     * Set carMileage
     *
     * @param integer $carMileage
     * @return bill
     */
    public function setCarMileage($carMileage) {
        $this->carMileage = $carMileage;
        return $this;
    }

    /**
     * Get carMileage
     *
     * @return integer 
     */
    public function getCarMileage() {
        return $this->carMileage;
    }

    /**
     * Set vatRate
     *
     * @param \Adagyo\FA69Bundle\Entity\vat $vatRate
     * @return bill
     */
    public function setVatRate(\Adagyo\FA69Bundle\Entity\vat $vatRate) {
        $this->vatRate = $vatRate;
        return $this;
    }

    /**
     * Get vatRate
     * @return \Adagyo\FA69Bundle\Entity\vat 
     */
    public function getVatRate() {
        return $this->vatRate;
    }

    /**
     * @ORM\PostLoad()
     */
    public function compute() {
        for($i = 0; $i < count($this->lines); $i++) {
            $currLine = $this->lines->get($i);
            $currQuality = $currLine->getQuality();
            $currQuantity = $currLine->getQuantity();
            $currDiscount = $currLine->getDiscount();
            $currPrice = $currLine->getUnitPriceVAT();

            $lineTotal = ($currPrice * (1 - $currDiscount / 100)) * $currQuantity;
            $this->totalDiscount += ($currPrice * $currQuantity) - $lineTotal;
            if(strtolower($currQuality) == 'neuf') {
                $this->totalVATNewPart += $lineTotal;
                $lineExVATTotal = $lineTotal / (1 + ($this->vatRate->getRate() / 100));
                $this->totalExVATNewPart += $lineExVATTotal;
                $this->VAT += $lineTotal - $lineExVATTotal;
            } else {
                $this->totalExVATOldPart += $lineTotal;
            }
        }
    }
}