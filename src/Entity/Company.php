<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"company_read"}},
 *     itemOperations={"get"},
 *     collectionOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class Company
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $identificationNumber;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="float", options={"default":0})
     */
    private $rating;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $score;

    /**
     * @Groups({"company_read"})
     * @ORM\ManyToMany(targetEntity=Category::class)
     */
    private $categories;

    /**
     * @Groups({"company_read"})
     * @ORM\ManyToMany(targetEntity=Image::class, cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback={"App\Enum\Status", "values"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="companies")
     */
    private $owner;

    /**
     * @Groups({"company_read"})
     * @ORM\OneToMany(targetEntity=Phone::class, mappedBy="company", orphanRemoval=true, cascade={"persist"})
     */
    private $phones;

    /**
     * @Groups({"company_read"})
     * @ORM\OneToMany(targetEntity=CompanyBadge::class, mappedBy="company", orphanRemoval=true, cascade={"persist"})
     */
    private $companyBadges;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="company", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="company", orphanRemoval=true)
     */
    private $products;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @Groups({"company_read"})
     * @ORM\OneToMany(targetEntity=Link::class, mappedBy="company", orphanRemoval=true, cascade={"persist"})
     */
    private $links;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="company", orphanRemoval=true)
     */
    private $reservations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @Groups({"company_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $tradingName;

    /**
     * @Groups({"company_read"})
     * @Gedmo\Slug(fields={"tradingName"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @Groups({"company_read"})
     * @ORM\ManyToOne(targetEntity=Image::class, cascade={"persist"})
     */
    private $logo;

    /**
     * @Groups({"company_read"})
     * @ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;

    public static function create()
    {
        return new static();
    }

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->companyBadges = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->links = new ArrayCollection();
        $this->reservations = new ArrayCollection();

        $this->rating = 0;
        $this->score = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentificationNumber(): ?string
    {
        return $this->identificationNumber;
    }

    public function setIdentificationNumber(?string $identificationNumber): self
    {
        $this->identificationNumber = $identificationNumber;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Phone[]
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): self
    {
        if (!$this->phones->contains($phone)) {
            $this->phones[] = $phone;
            $phone->setCompany($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): self
    {
        if ($this->phones->contains($phone)) {
            $this->phones->removeElement($phone);
            // set the owning side to null (unless already changed)
            if ($phone->getCompany() === $this) {
                $phone->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CompanyBadge[]
     */
    public function getCompanyBadges(): Collection
    {
        return $this->companyBadges;
    }

    public function addCompanyBadge(CompanyBadge $companyBadge): self
    {
        if (!$this->companyBadges->contains($companyBadge)) {
            $this->companyBadges[] = $companyBadge;
            $this->score += $companyBadge->getLevel()->getScore();
            $companyBadge->setCompany($this);
        }

        return $this;
    }

    public function removeCompanyBadge(CompanyBadge $companyBadge): self
    {
        if ($this->companyBadges->contains($companyBadge)) {
            $this->companyBadges->removeElement($companyBadge);
            $this->score -= $companyBadge->getLevel()->getScore();
            // set the owning side to null (unless already changed)
            if ($companyBadge->getCompany() === $this) {
                $companyBadge->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCompany($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getCompany() === $this) {
                $comment->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCompany($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getCompany() === $this) {
                $product->setCompany(null);
            }
        }

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection|Link[]
     */
    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Link $link): self
    {
        if (!$this->links->contains($link)) {
            $this->links[] = $link;
            $link->setCompany($this);
        }

        return $this;
    }

    public function removeLink(Link $link): self
    {
        if ($this->links->contains($link)) {
            $this->links->removeElement($link);
            // set the owning side to null (unless already changed)
            if ($link->getCompany() === $this) {
                $link->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setCompany($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getCompany() === $this) {
                $reservation->setCompany(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTradingName(): ?string
    {
        return $this->tradingName;
    }

    public function setTradingName(string $tradingName): self
    {
        $this->tradingName = $tradingName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getLogo(): ?Image
    {
        return $this->logo;
    }

    public function setLogo(?Image $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
