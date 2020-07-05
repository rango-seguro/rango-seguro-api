<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"image_read"}},
 *     itemOperations={"get"},
 *     collectionOperations={}
 * )
 *
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable()
 *
 * @author Igor Silva <igorqsilva@gmail.com>
 * @version 1.0
 */
class Image
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"image_read", "category_read", "company_read"})
     */
    private $contentUrl;

    /**
     * @Assert\NotNull()
     * @Vich\UploadableField(mapping="image", fileNameProperty="filePath")
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filePath;

    public static function create()
    {
        return new static();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentUrl(): ?string
    {
        //TODO: Avoid using this hard coded value
        return 'https://s3.amazonaws.com/rangoseguro/images/' . $this->filePath;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(File $file): self
    {
        $this->file = $file;

        if ($file) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }
}
