<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class Phone
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
     * @Assert\Choice(callback={"App\Enum\PhoneType", "values"})
     * @ORM\Column(type="string", length=255)
     */
    private $phoneType;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extension;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="phones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    public static function create()
    {
        return new static();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneType(): ?string
    {
        return $this->phoneType;
    }

    public function setPhoneType(string $phoneType): self
    {
        $this->phoneType = $phoneType;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
