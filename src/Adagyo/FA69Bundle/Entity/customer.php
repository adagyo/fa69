<?php

namespace Adagyo\FA69Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * customer
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Adagyo\FA69Bundle\Entity\customerRepository")
 */
class customer
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
     * @ORM\Column(name="civility", type="string", length=255)
     */
    private $civility;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255)
     * @Assert\NotBlank(message="Le champ 'Nom' est obligatoire")
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="postalcode", type="string", length=255)
     */
    private $postalcode;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="mobile", type="string", length=255)
     */
    private $mobile;

    /**
     * @ORM\OneToMany(targetEntity="Adagyo\FA69Bundle\Entity\car", mappedBy="customer")
     */
    private $cars;

    /**
     * Get id
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set civility
     * @param string $civility
     * @return customer
     */
    public function setCivility($civility) {
        $this->civility = $civility;
        return $this;
    }

    /**
     * Get civility
     * @return string 
     */
    public function getCivility() {
        return $this->civility;
    }

    /**
     * Set firstname
     * @param string $firstname
     * @return customer
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     * @param string $lastname
     * @return customer
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     * @return string 
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set address
     * @param string $address
     * @return customer
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     * @return string 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set postalcode
     * @param string $postalcode
     * @return customer
     */
    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
        return $this;
    }

    /**
     * Get postalcode
     * @return string 
     */
    public function getPostalcode() {
        return $this->postalcode;
    }

    /**
     * Set city
     * @param string $city
     * @return customer
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set phone
     * @param string $phone
     * @return customer
     */
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     * @return string 
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set mobile
     * @param string $mobile
     * @return customer
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * Get mobile
     * @return string 
     */
    public function getMobile() {
        return $this->mobile;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cars = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add cars
     *
     * @param \Adagyo\FA69Bundle\Entity\car $cars
     * @return customer
     */
    public function addCar(\Adagyo\FA69Bundle\Entity\car $car)
    {
        $this->cars[] = $car;
        $car->setCustomer($this);
        return $this;
    }

    /**
     * Remove car
     * @param \Adagyo\FA69Bundle\Entity\car $car
     */
    public function removeCar(\Adagyo\FA69Bundle\Entity\car $car)
    {
        $this->cars->removeElement($car);
    }

    /**
     * Get cars
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCars()
    {
        return $this->cars;
    }
}