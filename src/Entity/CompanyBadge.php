<?php

namespace App\Entity;

use App\Repository\CompanyBadgeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CompanyBadgeRepository::class)
 * @ORM\Table(
 *     uniqueConstraints={@ORM\UniqueConstraint(name="uniq_company_id_badge_id", columns={"company_id", "badge_id"})}
 * )
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class CompanyBadge
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
     * @ORM\ManyToOne(targetEntity=Badge::class)
     * @ORM\JoinColumn(name="badge_id", nullable=false)
     */
    private $badge;

    /**
     * @Groups({"company_read"})
     * @ORM\ManyToOne(targetEntity=Level::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="companyBadges")
     * @ORM\JoinColumn(name="company_id", nullable=false)
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

    public function getBadge(): ?Badge
    {
        return $this->badge;
    }

    public function setBadge(?Badge $badge): self
    {
        $this->badge = $badge;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

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
