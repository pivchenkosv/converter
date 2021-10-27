<?php

namespace App\Services\Conversion;

use App\Models\ConvertCurrency;
use App\Models\ConvertCurrencyLog;
use App\ResultTypes\Failure;
use App\ResultTypes\Success;

class ConversionService
{
    private ShouldConvert $converter;

    public function __construct(ShouldConvert $convertInterface)
    {
        $this->converter = $convertInterface;
    }

    public function convert(ConvertCurrency $from, $to, $amount): Success|Failure
    {
        $result = $this->converter->convert($from->name, $to, $amount);

        ConvertCurrencyLog::create([
            'amount' => $amount,
            'calculated_amount' => $result::class === Success::class ? $result->getResult() : null,
            'convert_currency_id' => $from->id,
            'crypto' => $to,
        ]);

        return match ($result::class) {
            Success::class => new Success($result->getResult()),
            Failure::class => new Failure($result->getCode(), $result->getMessage()),
        };
    }
}
