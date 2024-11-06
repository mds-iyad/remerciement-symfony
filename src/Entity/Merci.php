<?php

namespace App\Entity;

use App\Repository\MerciRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerciRepository::class)]
class Merci
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Salarie::class)]
    #[ORM\JoinColumn(nullable: true)] // Ensures that `author` is required
    private $author;

    #[ORM\ManyToOne(targetEntity: Salarie::class)]
    private $recipient;

    #[ORM\Column(length: 255)]
    private ?string $reason = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getAuthor(): ?Salarie
    {
        return $this->author;
    }

    public function setAuthor(?Salarie $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getRecipient(): ?Salarie
    {
        return $this->recipient;
    }

    public function setRecipient(?Salarie $recipient): self
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }
}
