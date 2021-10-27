<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertCurrencyRequest;
use App\Http\Resources\ConvertCurrency as ConvertCurrencyResource;
use App\Models\ConvertCurrency as ConvertCurrencyModel;
use App\ResultTypes\Failure;
use App\ResultTypes\Success;
use App\Services\Conversion\ConversionService;
use App\Services\Conversion\Converters\Exchangerate\ExchangeRateConverter;

class ConvertCurrency extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/currencies/get",
     *     @OA\Response(response="200", description="Get currencies available for conversion.")
     * )
     */
    public function get()
    {
        return ConvertCurrencyResource::collection(ConvertCurrencyModel::whereIsEnabled(true)->get());
    }

    /**
     * @OA\Post (
     *     path="/api/currencies/convert",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Convert currency",
     *         @OA\JsonContent(
     *             required={"currencyId","amount","to"},
     *             @OA\Property(property="currencyId", type="int", example=1),
     *             @OA\Property(property="amount", type="string", example="100"),
     *             @OA\Property(property="to", type="string", example="BTC"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Convert currency", @OA\JsonContent())
     * )
     */
    public function convert(ConvertCurrencyRequest $request)
    {
        $request->validated();

        $serviceResult = (new ConversionService(new ExchangeRateConverter()))
            ->convert(ConvertCurrencyModel::find($request->currencyId), $request->to, $request->amount);

        return match($serviceResult::class) {
            Success::class => response()->json(['amount' => $serviceResult->getResult()]),
            Failure::class => response()->json(['error' => $serviceResult->getMessage()], $serviceResult->getCode()),
        };
    }
}
