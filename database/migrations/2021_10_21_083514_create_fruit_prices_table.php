<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFruitPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fruit_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('fruit_id');
            $table->double('price_wholesale', 8, 2);
            $table->double('price_retial', 8, 2);
            $table->integer('price_location');
            $table->date('price_date');
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
        Schema::dropIfExists('fruit_prices');
    }
}
