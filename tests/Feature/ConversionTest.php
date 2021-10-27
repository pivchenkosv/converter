<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ConversionTest extends TestCase
{
    /**
     * Conversion successful.
     *
     * @return void
     */
    public function testConvertsCurrency()
    {
        Http::fake([
            'https://api.exchangerate.host/convert*' => Http::response(['result' => '123'], 200, []),
        ]);

        $response = $this->postJson('/api/currencies/convert', [
            'currencyId' => 1,
            'amount' => '100',
            'to' => 'BTC'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'amount' => '123'
        ]);
    }

    /**
     * Conversion successful.
     *
     * @return void
     */
    public function testValidatesRequest()
    {
        $response = $this->postJson('/api/currencies/convert', [
            'currencyId' => 1,
            'amount' => 'test',
            'to' => 'BTC'
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'amount' => [
                    'The amount must be a number.'
                ],
            ],
        ]);
    }

    /**
     * Conversion successful.
     *
     * @return void
     */
    public function testFailsToConvertNullResult()
    {
        Http::fake([
            'https://api.exchangerate.host/convert*' => Http::response(['result' => null], 200, []),
        ]);

        $response = $this->postJson('/api/currencies/convert', [
            'currencyId' => 1,
            'amount' => '100',
            'to' => 'BTC'
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'error' => 'Unable to process request'
        ]);
    }

    /**
     * Conversion successful.
     *
     * @return void
     */
    public function testFailsToConvertFailedApiResponse()
    {
        Http::fake([
            'https://api.exchangerate.host/convert*' => Http::response(['result' => null], 500, []),
        ]);

        $response = $this->postJson('/api/currencies/convert', [
            'currencyId' => 1,
            'amount' => '100',
            'to' => 'BTC'
        ]);

        $response->assertStatus(503);
        $response->assertJson([
            'error' => 'Third party service is unavailable. Try again later'
        ]);
    }
}
