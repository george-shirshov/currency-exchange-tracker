<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    private const ACCURACY = 10_000;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 3)]
    private string $numCode;

    #[ORM\Column(length: 3)]
    private string $charCode;

    #[ORM\Column]
    private ?int $nominal;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private int $value;

    #[ORM\Column]
    private int $unitRate;

    #[ORM\Column]
    private DateTimeImmutable $updateAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumCode(): string
    {
        return $this->numCode;
    }

    public function setNumCode(string $numCode): static
    {
        $this->numCode = $numCode;

        return $this;
    }

    public function getCharCode(): ?string
    {
        return $this->charCode;
    }

    public function setCharCode(string $charCode): static
    {
        $this->charCode = $charCode;

        return $this;
    }

    public function getNominal(): int
    {
        return $this->nominal;
    }

    public function setNominal(int $nominal): static
    {
        $this->nominal = $nominal;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getUnitRate(): int
    {
        return $this->unitRate;
    }

    public function setUnitRate(int $unitRate): static
    {
        $this->unitRate = $unitRate;

        return $this;
    }

    public function getUpdateAt(): DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}
