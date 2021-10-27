<?php

namespace Database\Seeders;

use App\Models\ConvertCurrency;
use Illuminate\Database\Seeder;

class ConvertCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConvertCurrency::insert([
            ['name' => 'EUR', 'is_enabled' => true],
            ['name' => 'USD', 'is_enabled' => true],
            ['name' => 'PLN', 'is_enabled' => true],
        ]);
    }
}
