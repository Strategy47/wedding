<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $avatar;

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
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $doubleBed = false;

    /**
     * @var BedRoom
     *
     * @ORM\ManyToOne(targetEntity="BedRoom", inversedBy="persons")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="id")
     */
    private $bedRoom;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="persons")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="id")
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
     * @param \DateTime $birthDate
     * @return Person
     */
    public function setBirthDate(\DateTime $birthDate) : Person
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
     * @param string $avatar
     * @return Person
     */
    public function setAvatar(string $avatar) : Person
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar() : string
    {
        if (null === $this->avatar) {
            return "uploads/avatar.jpg";
        }

        return 'uploads/avatar/' . $this->avatar . '.jpg';
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
     * @param BedRoom $bedRoom
     * @return Person
     */
    public function setBedRoom(BedRoom $bedRoom) : Person
    {
        $this->bedRoom = $bedRoom;

        return $this;
    }

    /**
     * @return BedRoom|null
     */
    public function getBedRoom() : ?BedRoom
    {
        return $this->bedRoom;
    }

    /**
     * @param bool $doubleBed
     * @return Person
     */
    public function setDoubleBed(bool $doubleBed) : Person
    {
        $this->doubleBed = $doubleBed;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDoubleBed() : bool
    {
        return $this->doubleBed;
    }
}
