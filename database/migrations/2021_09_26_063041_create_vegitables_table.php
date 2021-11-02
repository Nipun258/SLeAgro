<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVegitablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vegitables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('catagory');
            $table->integer('total_area')->comment('Total area of culativate in Sri Lanka (Ha)');
            $table->integer('total_producation')->comment('Total production particular product(mt)');
            $table->integer('annual_crop_count')->comment('how many time can crop pre year');
            $table->string('short_dis')->nullable();
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
        Schema::dropIfExists('vegitables');
    }
}
