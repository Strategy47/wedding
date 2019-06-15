<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     mercure=true,
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={"get"},
 *     collectionOperations={"post","get"})
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\Email(
     *     message = "L'adresse {{ value }} n'existe pas.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true, unique=false)
     * @Assert\NotBlank(message = "Veuillez renseigner un numéro de téléphone")
     * @Assert\Regex(
     *     pattern="/^(0|\+33)[1-9](?:[\.\-\s]?\d\d){4}$/",
     *     match=true,
     *     message="Numéro de téléphone incorrect '{{ value }}'"
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     * Assert\NotBlank(message = "Veuillez renseigner une adresse")
     */
    private $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     * Assert\NotBlank(message = "Veuillez renseigner une ville.")
     */
    private $city;

    /**
     * @ORM\Column(type="string", nullable=true, length=5)
     * Assert\NotBlank(message = "Veuillez renseigner un code postale")
     */
    private $zipCode;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Housing")
     */
    private $housings;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $invitedBy;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Person", mappedBy="user", cascade={"all"}, orphanRemoval=true)
     */
    private $persons;

    private $superAdmin = false;

    /**
     * @Groups({"edit"})
     */
    private $group = array();

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->persons = new ArrayCollection();
        $this->housings = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone(string $phone) : User
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhone() : ?string
    {
        return $this->phone;
    }

    /**
     * @param string $address
     * @return User
     */
    public function setAddress(string $address) : User
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress() : ?string
    {
        return $this->address;
    }

    /**
     * @param string $city
     * @return User
     */
    public function setCity(string $city) : User
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCity() : ?string
    {
        return $this->city;
    }

    /**
     * @param string $zipCode
     * @return User
     */
    public function setZipCode(string $zipCode) : User
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode() : ?string
    {
        return $this->zipCode;
    }

    /**
     * @param Housing $housing
     * @return User
     */
    public function addHousing(Housing $housing) : User
    {
        $this->housings[] = $housing;

        return $this;
    }

    /**
     * @param Housing $housing
     * @return User
     */
    public function removeHousing(Housing $housing) : User
    {
        $this->housings->removeElement($housing);

        return $this;
    }

    /**
     * @return \Countable
     */
    public function getHousings() : \Countable
    {
        return $this->housings;
    }

    /**
     * @param Person $person
     * @return User
     */
    public function addPerson(Person $person) : User
    {
        if (null === $person->getUser()) {
            $person->setUser($this);
        }

        $this->persons[] = $person;

        return $this;
    }

    /**
     * @param Person $person
     * @return User
     */
    public function removePerson(Person $person) : User
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
     * @param string $invitedBy
     * @return User
     */
    public function setInvitedBy(string $invitedBy) : self
    {
        $this->invitedBy = $invitedBy;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getInvitedBy() : ?string
    {
        return $this->invitedBy;
    }
}
