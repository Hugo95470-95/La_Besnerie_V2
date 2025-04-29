<?php

// namespace App\Entity;

// use App\Repository\ProductRepository;
// use Doctrine\DBAL\Types\Types;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: ProductRepository::class)]
// class Product
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column(type: Types::TEXT)]
//     private ?string $Description = null;

//     #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
//     private ?string $Price = null;

//     #[ORM\Column(length: 255)]
//     private ?string $Category = null;

//     #[ORM\Column(type: Types::TEXT)]
//     private ?string $Image_main = null;

//     #[ORM\Column(type: Types::TEXT)]
//     private ?string $Image_supp = null;

//     #[ORM\Column(length: 255)]
//     private ?string $Name = null;

//     #[ORM\ManyToOne(inversedBy: 'name_key')]
//     private ?Order $name_key = null;

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getDescription(): ?string
//     {
//         return $this->Description;
//     }

//     public function setDescription(string $Description): static
//     {
//         $this->Description = $Description;

//         return $this;
//     }

//     public function getPrice(): ?string
//     {
//         return $this->Price;
//     }

//     public function setPrice(string $Price): static
//     {
//         $this->Price = $Price;

//         return $this;
//     }

//     public function getCategory(): ?string
//     {
//         return $this->Category;
//     }

//     public function setCategory(string $Category): static
//     {
//         $this->Category = $Category;

//         return $this;
//     }

//     public function getImageMain(): ?string
//     {
//         return $this->Image_main;
//     }

//     public function setImageMain(string $Image_main): static
//     {
//         $this->Image_main = $Image_main;

//         return $this;
//     }

//     public function getImageSupp(): ?string
//     {
//         return $this->Image_supp;
//     }

//     public function setImageSupp(string $Image_supp): static
//     {
//         $this->Image_supp = $Image_supp;

//         return $this;
//     }

//     public function getName(): ?Order
//     {
//         return $this->Name;
//     }

//     public function setName(?Order $Name): static
//     {
//         $this->Name = $Name;

//         return $this;
//     }

//     public function getNameKey(): ?Order
//     {
//         return $this->name_key;
//     }

//     public function setNameKey(?Order $name_key): static
//     {
//         $this->name_key = $name_key;

//         return $this;
//     }
// }







namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Price = null;

    #[ORM\Column(length: 255)]
    private ?string $Category = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Image_main = null;

    // #[ORM\Column(type: Types::TEXT)]
    // private ?string $Image_supp = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getImageMain(): ?string
    {
        return $this->Image_main;
    }

    public function setImageMain(string $Image_main): self
    {
        $this->Image_main = $Image_main;

        return $this;
    }

    // public function getImageSupp(): ?string
    // {
    //     return $this->Image_supp;
    // }

    public function setImageSupp(string $Image_supp): self
    {
        $this->Image_supp = $Image_supp;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
}