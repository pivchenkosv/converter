<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheck extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/healthcheck",
     *     @OA\Response(response="200", description="Health check endpoint.")
     * )
     */
    public function healthCheck()
    {
        return response()->json('OK');
    }
}
