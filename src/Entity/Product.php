<?php

namespace App\Entity;

class Product
{
    private $sku;
    private $slug;
    private $price;
    private $currency;
    private $description;
    private $status;
    private $createdAt;

    public function __construct(array $product = [])
    {
        if (!empty($product)) {
            $this->sku = $product[0];
            $this->slug = $product[1];
            $this->status = $product[2];
            $this->price = $product[3];
            $this->currency = $product[4];
            $this->description = $product[5];
            $this->createdAt = new \DateTimeImmutable($product[6]);
        }
    }

    public function getSku(): ?int
    {
        return $this->sku;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getPrice(): ?string
    {
        return str_replace('.', ',', $this->price) . $this->currency;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

}