<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $User_ID = null;

    #[ORM\Column]
    private ?int $Product_ID = null;

    #[ORM\Column(length: 255)]
    private ?string $Product_name = null;

    #[ORM\Column]
    private ?int $Product_quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Total_price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Order_date = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'name_key')]
    private Collection $name_key;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Payment $name_key2 = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $name_key3 = null;

    public function __construct()
    {
        $this->name_key = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUserID(): ?int
    {
        return $this->User_ID;
    }

    public function setUserID(int $User_ID): static
    {
        $this->User_ID = $User_ID;

        return $this;
    }

    public function getProductID(): ?int
    {
        return $this->Product_ID;
    }

    public function setProductID(int $Product_ID): static
    {
        $this->Product_ID = $Product_ID;

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

    public function getProductQuantity(): ?int
    {
        return $this->Product_quantity;
    }

    public function setProductQuantity(int $Product_quantity): static
    {
        $this->Product_quantity = $Product_quantity;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->Total_price;
    }

    public function setTotalPrice(string $Total_price): static
    {
        $this->Total_price = $Total_price;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeImmutable
    {
        return $this->Order_date;
    }

    public function setOrderDate(\DateTimeImmutable $Order_date): static
    {
        $this->Order_date = $Order_date;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getNameKey(): Collection
    {
        return $this->name_key;
    }

    public function addNameKey(Product $nameKey): static
    {
        if (!$this->name_key->contains($nameKey)) {
            $this->name_key->add($nameKey);
            $nameKey->setNameKey($this);
        }

        return $this;
    }

    public function removeNameKey(Product $nameKey): static
    {
        if ($this->name_key->removeElement($nameKey)) {
            // set the owning side to null (unless already changed)
            if ($nameKey->getNameKey() === $this) {
                $nameKey->setNameKey(null);
            }
        }

        return $this;
    }

    public function getNameKey2(): ?Payment
    {
        return $this->name_key2;
    }

    public function setNameKey2(?Payment $name_key2): static
    {
        $this->name_key2 = $name_key2;

        return $this;
    }

    public function getNameKey3(): ?User
    {
        return $this->name_key3;
    }

    public function setNameKey3(?User $name_key3): static
    {
        $this->name_key3 = $name_key3;

        return $this;
    }

}
