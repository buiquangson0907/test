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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_product_id')->nullable();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('code',20)->nullable();
            $table->tinyInteger('warranty')->nullable()->default(0); // bảo hành tháng
            $table->tinyInteger('status')->nullable()->default(1); // trạng thái còn hàng
            $table->integer('views')->nullable();
            $table->decimal('cost',25,2)->nullable(); // giá gốc
            $table->decimal('price',25,2)->nullable(); // giá bán
            $table->integer('quantity')->nullable(); // số lượng
            $table->string('image')->nullable();
            $table->text('summary')->nullable(); // mô tả ngắn
            $table->text('offer')->nullable(); // quá tặng & ưu đãi
            $table->longText('content')->nullable();
            $table->longText('specifications')->nullable(); // thông số kỹ thuật
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('group_product_id')->references('id')->on('group_products');//->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
