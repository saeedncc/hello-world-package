<?php

namespace App\Entity;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\TripRepository;

#[ORM\Entity(repositoryClass: TripRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Trip
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
	
	
	
	#[ORM\ManyToOne(targetEntity: Driver::class, inversedBy: 'trips')]
    #[ORM\JoinColumn(name: 'driver_id', referencedColumnName: 'id')]
    private ?Driver $driver = null;
	
	
	#[ORM\ManyToOne(targetEntity: Truck::class, inversedBy: 'trips')]
    #[ORM\JoinColumn(name: 'truck_id', referencedColumnName: 'id')]
    private ?Truck $truck = null;


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
	
	
	public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): static
    {
        $this->driver = $driver;

        return $this;
    }
	
	
	public function getTruck(): ?Truck
    {
        return $this->truck;
    }

    public function setTruck(?Truck $truck): static
    {
        $this->truck = $truck;

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
