<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Accueil = null;

    #[ORM\Column(length: 255)]
    private ?string $Presentation = null;

    #[ORM\Column(length: 255)]
    private ?string $Media = null;

    #[ORM\Column(length: 255)]
    private ?string $Boutique = null;

    #[ORM\Column(length: 255)]
    private ?string $Contact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccueil(): ?string
    {
        return $this->Accueil;
    }

    public function setAccueil(string $Accueil): static
    {
        $this->Accueil = $Accueil;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->Presentation;
    }

    public function setPresentation(string $Presentation): static
    {
        $this->Presentation = $Presentation;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->Media;
    }

    public function setMedia(string $Media): static
    {
        $this->Media = $Media;

        return $this;
    }

    public function getBoutique(): ?string
    {
        return $this->Boutique;
    }

    public function setBoutique(string $Boutique): static
    {
        $this->Boutique = $Boutique;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->Contact;
    }

    public function setContact(string $Contact): static
    {
        $this->Contact = $Contact;

        return $this;
    }
}
