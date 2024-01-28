<?php

namespace App\Service;

use App\Entity\Currency;
use App\Serializer\Normalizer\CurrencyNormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class DownloadCurrenciesService
{
    private const URL = 'https://cbr.ru/scripts/XML_daily.asp';

    public function __construct(
        private HttpClientInterface $client
    ) {
    }

    /**
     * @return Currency[]
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function fetch(): array
    {
        $rawData = $this->client->request('GET', self::URL)->getContent();
        $serializer = new Serializer([new CurrencyNormalizer()], [new XmlEncoder()]);
        return $serializer->deserialize($rawData, Currency::class . '[]','xml');
    }
}
