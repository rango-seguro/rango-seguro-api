<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LinkRepository::class)
 * @ORM\Table(
 *     uniqueConstraints={@ORM\UniqueConstraint(name="uniq_company_id_platform_id", columns={"company_id", "platform_id"})}
 * )
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class Link
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
    private $path;

    /**
     * @Groups({"company_read"})
     * @ORM\ManyToOne(targetEntity=Platform::class)
     * @ORM\JoinColumn(nullable=false, name="platform_id")
     */
    private $platform;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="links")
     * @ORM\JoinColumn(nullable=false, name="company_id")
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

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): self
    {
        $this->platform = $platform;

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
