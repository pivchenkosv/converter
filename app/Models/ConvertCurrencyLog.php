<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvertCurrencyLog extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'calculated_amount', 'convert_currency_id', 'crypto'];
}
