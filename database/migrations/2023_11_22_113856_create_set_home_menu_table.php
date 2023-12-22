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
        Schema::create('set_home_menu', function (Blueprint $table) {
            $table->unsignedBigInteger('group_product_id');
            $table->tinyInteger('status_home')->nullable()->default(0);
            $table->tinyInteger('sort_home')->nullable();
            $table->unsignedInteger('parent_home_id')->nullable()->default(null);

            $table->foreign('group_product_id')->references('id')->on('group_products');

            $table->primary(['group_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_home_menu');
    }
};
