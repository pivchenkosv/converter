<?php

namespace App\Services\Conversion\Converters\Exchangerate;

use App\ApiClients\Exchangerate\ExchangeRateApi;
use App\Services\Conversion\ShouldConvert;
use App\ResultTypes\Success;
use App\ResultTypes\Failure;

class ExchangeRateConverter implements ShouldConvert
{

    public function convert(string $from, string $to, string $amount): Success|Failure
    {
        $response = (new ExchangeRateApi())->convert($from, $to, $amount);
        $result = $response->object()->result;

        return match (true) {
            $response->ok() && is_numeric($result) => new Success($result),
            $response->ok() && !is_numeric($result) => new Failure(422, 'Unable to process request'),
            !$response->ok() => new Failure(503, 'Third party service is unavailable. Try again later'),
        };
    }
}
