<?php

use App\Models\ConvertCurrency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertCurrencyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convert_currency_logs', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('calculated_amount')->nullable();
            $table->foreignIdFor(ConvertCurrency::class);
            $table->string('crypto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convert_currency_logs');
    }
}
