<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_galleries', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->integer('serial_id');
            $table->string('name');
            $table->string('type');
            $table->foreign('product_id')->references('id')->on('products');//->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['product_id', 'serial_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_galleries');
    }
};
