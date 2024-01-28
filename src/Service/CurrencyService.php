<?php

namespace App\Service;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;

readonly class CurrencyService
{
    public function __construct(
        private CurrencyRepository $repository,
    ) {
    }

    /** @return Currency[] */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function getByNumCode(string $numCode): Currency
    {
        return $this->repository->getByNumCode($numCode);
    }
}
