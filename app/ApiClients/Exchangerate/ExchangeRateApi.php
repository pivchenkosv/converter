<?php

namespace App\ApiClients\Exchangerate;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ExchangeRateApi
{
    private string $baseUrl = 'https://api.exchangerate.host';

    public function convert(string $from, string $to, string $amount): Response
    {
        return Http::get("{$this->baseUrl}/convert", [
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
        ]);
    }
}
