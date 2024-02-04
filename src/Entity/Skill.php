<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
#[UniqueEntity('name')]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\ManyToOne(inversedBy: 'skill')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Experience::class, inversedBy: 'skills')]
    private Collection $experience;

    #[ORM\ManyToMany(targetEntity: Work::class, inversedBy: 'skills')]
    private Collection $work;

    public function __construct()
    {
        $this->experience = new ArrayCollection();
        $this->work = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getExperience(): Collection
    {
        return $this->experience;
    }

    public function addExperience(Experience $experience): static
    {
        if (!$this->experience->contains($experience)) {
            $this->experience->add($experience);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): static
    {
        $this->experience->removeElement($experience);

        return $this;
    }

    /**
     * @return Collection<int, Work>
     */
    public function getWork(): Collection
    {
        return $this->work;
    }

    public function addWork(Work $work): static
    {
        if (!$this->work->contains($work)) {
            $this->work->add($work);
        }

        return $this;
    }

    public function removeWork(Work $work): static
    {
        $this->work->removeElement($work);

        return $this;
    }
}
