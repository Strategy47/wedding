<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * User
 *
 * @ApiResource(
 *     mercure=true,
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={"get"},
 *     collectionOperations={"post","get"})
 * @ORM\Entity
 */
class Housing
{
    const TYPE = array('Villa', 'Gîte');

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
     * @ORM\OneToMany(targetEntity="Person", mappedBy="housing", cascade={"all"}, orphanRemoval=true)
     */
    private $persons;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    private $area = 0.00;

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
        $this->persons = new ArrayCollection();
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
     * @param Photo $photo
     * @return Housing
     */
    public function addPhoto(Photo $photo) : Housing
    {
        if (null === $photo->getHousing()) {
            $photo->setHousing($this);
        }

        $this->photos[] = $photo;

        return $this;
    }

    /**
     * @param Photo $photo
     * @return Housing
     */
    public function removePhoto(Photo $photo) : Housing
    {
        $this->photos->removeElement($photo);

        return $this;
    }

    /**
     * @return \Countable
     */
    public function getPhotos() : \Countable
    {
        return $this->photos;
    }

    /**
     * @param int $singleBed
     * @return Housing
     */
    public function setSingleBed(int $singleBed) : self
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
     * @return Housing
     */
    public function setDoubleBed(int $doubleBed) : self
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
     * @param float $area
     * @return Housing
     */
    public function setArea(float $area) : self
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getArea() : ?float
    {
        return $this->area;
    }

    /**
     * @param Person $person
     * @return Housing
     */
    public function addPerson(Person $person) : self
    {
        if (null === $person->getHousing()) {
            $person->setHousing($this);
        }
        $this->persons[] = $person;
        return $this;
    }

    /**
     * @param Person $person
     * @return Housing
     */
    public function removePerson(Person $person) : self
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
}
