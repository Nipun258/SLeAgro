<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_centres', function (Blueprint $table) {
            $table->id();
            $table->string('centre_name');
            $table->string('centre_type')->nullable();
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('city_id');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('economic_centres');
    }
}
