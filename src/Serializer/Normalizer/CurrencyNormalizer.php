<?php

namespace App\Serializer\Normalizer;

use App\Entity\Currency;
use App\Mapper\CurrencyMapper;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

readonly class CurrencyNormalizer implements DenormalizerInterface
{
    private CurrencyMapper $currencyMapper;

    public function __construct()
    {
        $this->currencyMapper = new CurrencyMapper();
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        return array_map(function ($item) {
            return $this->currencyMapper->mapFromRequest($item);
        }, $data['Valute']);
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Currency::class.'[]' => true,
        ];
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return !empty($data) && $format === 'xml';
    }
}
