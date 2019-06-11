<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table("photos")
 * @ORM\Entity
 */
class Photo
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
     * @var Housing
     *
     * @ORM\ManyToOne(targetEntity="Housing", inversedBy="photos")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="id")
     */
    private $housing;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param Housing $housing
     * @return Photo
     */
    public function setHousing(Housing $housing) : Photo
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
