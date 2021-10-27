<?php

use Database\Seeders\ConvertCurrencySeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convert_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_enabled');
            $table->timestamps();
        });

        $seeder = new ConvertCurrencySeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convert_currencies');
    }
}
