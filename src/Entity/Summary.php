<?php

namespace App\Entity;

use App\Repository\SummaryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SummaryRepository::class)]
class Summary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Order_number = null;

    #[ORM\Column(length: 255)]
    private ?string $Order_name = null;

    #[ORM\Column(length: 255)]
    private ?string $Product_name = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?int
    {
        return $this->Order_number;
    }

    public function setOrderNumber(int $Order_number): static
    {
        $this->Order_number = $Order_number;

        return $this;
    }

    public function getOrderName(): ?string
    {
        return $this->Order_name;
    }

    public function setOrderName(string $Order_name): static
    {
        $this->Order_name = $Order_name;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->Product_name;
    }

    public function setProductName(string $Product_name): static
    {
        $this->Product_name = $Product_name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->Created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $Created_at): static
    {
        $this->Created_at = $Created_at;

        return $this;
    }
}
