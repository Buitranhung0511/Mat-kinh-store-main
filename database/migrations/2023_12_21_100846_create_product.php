<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {

            $table->increments('product_id');
            $table->string('product_name')->unique();
            $table->string('product_quantity');
            $table->integer('category_id');
            $table->text('product_desc');
            $table->text('product_content');
            $table->string('product_price');
            $table->string('product_image');
            $table->integer('product_status');


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};