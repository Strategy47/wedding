<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Entity
 */
class Housing
{
    const TYPE = array('villa', 'gite');

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    private $price = 0.00;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BedRoom", mappedBy="housing", cascade={"all"}, orphanRemoval=true)
     */
    private $bedRooms;

    /**
     * TODO : ManyToMany ? create getter and setter
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="housing", cascade={"all"}, orphanRemoval=true)
     */
    private $photos;

    /**
     * Housing constructor.
     */
    public function __construct()
    {
        $this->bedRooms = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param string $type
     * @return Housing
     */
    public function setType(string $type) : Housing
    {
        if (false === in_array($type, self::TYPE, true)) {
            throw new \LogicException('Invalid type!');
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getCapacity() : int
    {
        $c = 0;

        foreach ($this->bedRooms as $bedRoom) {
            $c += $bedRoom->getCapacity();
        }

        return $c;
    }

    /**
     * @param float $price
     * @return Housing
     */
    public function setPrice(float $price) : Housing
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
     * @param Bedroom $bedRoom
     * @return Housing
     */
    public function addBedroom(Bedroom $bedRoom) : Housing
    {
        if (null === $bedRoom->getHousing()) {
            $bedRoom->setHousing($this);
        }

        $this->bedRooms[] = $bedRoom;

        return $this;
    }

    /**
     * @param Bedroom $bedRoom
     * @return Housing
     */
    public function removeBedroom(Bedroom $bedRoom) : Housing
    {
        $this->bedRooms->removeElement($bedRoom);

        return $this;
    }

    /**
     * @return \Countable
     */
    public function getBedrooms() : \Countable
    {
        return $this->bedRooms;
    }
}
