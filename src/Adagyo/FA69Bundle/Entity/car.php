<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * car
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Adagyo\FA69Bundle\Entity\carRepository")
 * @ExclusionPolicy("none")
 */
class car
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="regPlate", type="string", length=255)
     * @Assert\NotBlank(message="Le champ ""Plaque d'immatriculation"" est obligatoire")
     */
    private $regPlate;

    /**
     * @var string
     * @ORM\Column(name="brand", type="string", length=255)
     * @Assert\NotBlank(message="Le champ ""Marque"" est obligatoire")
     */
    private $brand;

    /**
     * @var string
     * @ORM\Column(name="year", type="string", length=255, nullable=true)
     */
    private $year;

    /**
     * @var integer
     * @ORM\Column(name="mileage", type="integer", nullable=true)

     */
    private $mileage;

    /**
     * @ORM\ManyToOne(targetEntity="Adagyo\FA69Bundle\Entity\customer", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     * @Exclude
     */
    private $customer;

    /**
     * Get id
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set regPlate
     * @param string $regPlate
     * @return car
     */
    public function setRegPlate($regPlate) {
        $this->regPlate = $regPlate;
        return $this;
    }

    /**
     * Get regPlate
     * @return string 
     */
    public function getRegPlate() {
        return $this->regPlate;
    }

    /**
     * Set brand
     * @param string $brand
     * @return car
     */
    public function setBrand($brand) {
        $this->brand = $brand;
        return $this;
    }

    /**
     * Get brand
     * @return string 
     */
    public function getBrand() {
        return $this->brand;
    }

    /**
     * Set year
     * @param string $year
     * @return car
     */
    public function setYear($year) {
        $this->year = $year;
        return $this;
    }

    /**
     * Get year
     * @return string 
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * Set mileage
     * @param integer $mileage
     * @return car
     */
    public function setMileage($mileage) {
        $this->mileage = $mileage;
        return $this;
    }

    /**
     * Get mileage
     * @return integer 
     */
    public function getMileage() {
        return $this->mileage;
    }

    /**
     * Set customer
     * @param customer $customer
     * @return car
     */
    public function setCustomer($customer) {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Get customer
     * @return customer
     */
    public function getCustomer() {
        return $this->customer;
    }
}