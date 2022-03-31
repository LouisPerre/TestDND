<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sku;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): ?int
    {
        return $this->sku;
    }

    public function setSku(?int $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPrice(): ?string
    {
        return str_replace('.', ',', $this->price) . $this->getCurrency();
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        if (str_contains($description, '\r')) {
            $description = str_replace('\r', "\n", $description);
        }   elseif (str_contains($description, '<br/>')) {
            $description = str_replace('<br/>', "\n", $description);
        }
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
