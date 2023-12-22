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
        Schema::create('product_options', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->integer('serial_id');
            $table->string('name');
            $table->decimal('cost',25,2)->nullable(); // giá gốc
            $table->decimal('price',25,2)->nullable(); // giá bán
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
        Schema::dropIfExists('product_options');
    }
};
