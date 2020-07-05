<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class Address
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $zipCode;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $neighborhood;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complement;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $buildingNumber;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="float")
     */
    private $longitude;

    public static function create()
    {
        return new static();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function setNeighborhood(string $neighborhood): self
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(string $buildingNumber): self
    {
        $this->buildingNumber = $buildingNumber;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}
