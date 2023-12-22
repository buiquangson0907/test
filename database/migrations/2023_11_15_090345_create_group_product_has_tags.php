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
        Schema::create('group_product_has_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('group_product_id');
            $table->unsignedBigInteger('group_tag_id');

            $table->foreign('group_product_id')->references('id')->on('group_products');
            $table->foreign('group_tag_id')->references('id')->on('group_tags');


            $table->primary(['group_product_id', 'group_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_product_has_tags');
    }
};
