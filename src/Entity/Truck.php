<?php

namespace App\Entity;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\TruckRepository;

#[ORM\Entity(repositoryClass: TruckRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Truck
{
	
	#[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;
	
	
	#[ORM\Column(length: 80)]
	#[Assert\Regex('/\w+/i')]
	#[Assert\Length(max: 80)]
    private ?string $title = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
	
	
	public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

	#[ORM\PrePersist]
    public function setCreatedAt(): static
    {
        $this->createdAt = new DateTimeImmutable('now');

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

	#[ORM\PrePersist]
	#[ORM\PreUpdate]
    public function setUpdatedAt(): static
    {
        $this->updatedAt = new DateTimeImmutable('now');

        return $this;
    }


}
