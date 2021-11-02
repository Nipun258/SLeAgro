<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nic');
            $table->integer('collection_centre_id');
            $table->integer('economic_centre_id');
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('city_id');
            $table->string('pass_name')->nullable();
            $table->integer('bank_id')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('farmers');
    }
}
