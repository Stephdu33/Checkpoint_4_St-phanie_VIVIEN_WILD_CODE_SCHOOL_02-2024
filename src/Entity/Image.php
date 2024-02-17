<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $photo = null;

    #[Vich\UploadableField(mapping: 'photo_file', fileNameProperty: 'photo')]
     private ?File $photoFile = null;

     public function setPhotoFile(File $picture = null): Image
    {
        $this->photoFile = $picture;
        return $this;
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }

    #[ORM\ManyToOne(inversedBy: 'image')]
    private ?Work $work = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getWork(): ?Work
    {
        return $this->work;
    }

    public function setWork(?Work $work): static
    {
        $this->work = $work;

        return $this;
    }
}
