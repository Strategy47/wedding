<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     mercure=true,
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={"get"},
 *     collectionOperations={"post","get"})
 * @ORM\Entity
 */
class Person
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
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $participate = true;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $eats = true;

    /**
     * @var Housing
     *
     * @ORM\ManyToOne(targetEntity="Housing", inversedBy="persons")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="id")
     */
    private $housing;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="persons")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $user;

    /**
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param string $firstName
     * @return Person
     */
    public function setFirstName(string $firstName) : Person
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFirstName() : ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     * @return Person
     */
    public function setLastName(string $lastName) : Person
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLastName() : ?string
    {
        return $this->lastName;
    }

    /**
     * @param \DateTime|null $birthDate
     * @return Person
     */
    public function setBirthDate(?\DateTime $birthDate) : Person
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirthDate() : ?\DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param bool $participate
     * @return Person
     */
    public function setParticipate(bool $participate) : Person
    {
        $this->participate = $participate;

        return $this;
    }

    /**
     * @return bool
     */
    public function getParticipate() : bool
    {
        return $this->participate;
    }

    /**
     * @param User $user
     * @return Person
     */
    public function setUser(User $user) : Person
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser() : ?User
    {
        return $this->user;
    }

    /**
     * @param Housing $housing
     * @return Person
     */
    public function setHousing(Housing $housing) : self
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

    /**
     * @param bool $eats
     * @return Person
     */
    public function setEats(bool $eats) : Person
    {
        $this->eats = $eats;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEats() : bool
    {
        return $this->eats;
    }
}
