<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $User_name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Amount = null;

    #[ORM\Column(length: 255)]
    private ?string $Payment_method = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Payment_date = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Summary $name_key = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->User_name;
    }

    public function setUserName(string $User_name): static
    {
        $this->User_name = $User_name;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(string $Amount): static
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->Payment_method;
    }

    public function setPaymentMethod(string $Payment_method): static
    {
        $this->Payment_method = $Payment_method;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeImmutable
    {
        return $this->Payment_date;
    }

    public function setPaymentDate(\DateTimeImmutable $Payment_date): static
    {
        $this->Payment_date = $Payment_date;

        return $this;
    }

    public function getNameKey(): ?Summary
    {
        return $this->name_key;
    }

    public function setNameKey(?Summary $name_key): static
    {
        $this->name_key = $name_key;

        return $this;
    }
}
