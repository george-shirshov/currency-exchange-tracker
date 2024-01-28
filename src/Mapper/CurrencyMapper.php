<?php

namespace App\Mapper;

use App\Entity\Currency;

class CurrencyMapper
{
    public function mapFromRequest(array $data): Currency
    {
        $currency = new Currency();
        $currency->setNumCode($data['NumCode']);
        $currency->setCharCode($data['CharCode']);
        $currency->setNominal($data['Nominal']);
        $currency->setName($data['Name']);
        $currency->setValueFromString($data['Value']);
        $currency->setUnitRateFromString($data['VunitRate']);
        return $currency;
    }
}
