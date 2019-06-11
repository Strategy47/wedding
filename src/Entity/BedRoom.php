<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * BedRoom
 *
 * @ORM\Entity
 */
class BedRoom
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
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $singleBed = 0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $doubleBed = 0;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    private $price = 0.00;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Person", mappedBy="bedRoom", cascade={"all"}, orphanRemoval=true)
     */
    private $persons;

    /**
     * @var Housing
     *
     * @ORM\ManyToOne(targetEntity="Housing", inversedBy="bedRooms")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $housing;

    /**
     * Housing constructor.
     */
    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCapacity() : int
    {
        return ($this->getDoubleBed() * 2) + $this->getSingleBed();
    }

    /**
     * @param int $singleBed
     * @return BedRoom
     */
    public function setSingleBed(int $singleBed) : BedRoom
    {
        $this->singleBed = $singleBed;

        return $this;
    }

    /**
     * @return int
     */
    public function getSingleBed() : int
    {
        return $this->singleBed;
    }

    /**
     * @param int $doubleBed
     * @return BedRoom
     */
    public function setDoubleBed(int $doubleBed) : BedRoom
    {
        $this->doubleBed = $doubleBed;

        return $this;
    }

    /**
     * @return int
     */
    public function getDoubleBed() : int
    {
        return $this->doubleBed;
    }

    /**
     * @param float $price
     * @return BedRoom
     */
    public function setPrice(float $price) : BedRoom
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * @param Person $person
     * @return BedRoom
     */
    public function addPerson(Person $person) : BedRoom
    {
        if (null === $person->getBedRoom()) {
            $person->setBedRoom($this);
        }

        $this->persons[] = $person;

        return $this;
    }

    /**
     * @param Person $person
     * @return BedRoom
     */
    public function removePerson(Person $person) : BedRoom
    {
        $this->persons->removeElement($person);

        return $this;
    }

    /**
     * @return \Countable
     */
    public function getPersons() : \Countable
    {
        return $this->persons;
    }

    /**
     * @param Housing $housing
     * @return BedRoom
     */
    public function setHousing(Housing $housing) : BedRoom
    {
        $this->housing = $housing;

        return $this;
    }

    /**
     * @return Housing|null
     */
    public function getHousing() : ?Housing
    {
        return $this->housing;
    }
}
