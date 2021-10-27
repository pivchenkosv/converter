<?php

namespace App\Services\Conversion;

use App\ResultTypes\Failure;
use App\ResultTypes\Success;

interface ShouldConvert
{
    public function convert(string $from, string $to, string $amount): Success|Failure;
}
