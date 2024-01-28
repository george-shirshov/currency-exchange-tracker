<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Currency
{
    public const ACCURACY = 10_000;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 3, unique: true)]
    private string $numCode;

    #[ORM\Column(length: 3, unique: true)]
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

    public function getFormattedValue(): float
    {
        return $this->value / self::ACCURACY;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function setValueFromString(string $value): static
    {
        $this->value = $this->convertCurrencyValue($value);

        return $this;
    }

    public function getUnitRate(): int
    {
        return $this->unitRate;
    }

    public function getFormattedUnitRate(): int
    {
        return $this->unitRate / self::ACCURACY;
    }

    public function setUnitRate(int $unitRate): static
    {
        $this->unitRate = $unitRate;

        return $this;
    }

    public function setUnitRateFromString(string $unitRate): static
    {
        $this->unitRate = $this->convertCurrencyValue($unitRate);

        return $this;
    }

    public function getUpdateAt(): string
    {
        return $this->updateAt->format('d/m/Y');
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->updateAt = new \DateTimeImmutable();
    }

    private function convertCurrencyValue(string $value): int
    {
        return (float)str_replace(',', '.', $value) * Currency::ACCURACY;
    }
}
