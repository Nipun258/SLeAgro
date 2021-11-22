<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('invoice_id');
            $table->integer('user_id')->nullable();
            $table->integer('ccentre_id')->nullable();
            $table->integer('ecentre_id')->nullable();
            $table->string('date');
            $table->integer('veg_id');
            $table->double('quntity');
            $table->double('price', 8, 2)->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('inventories');
    }
}
