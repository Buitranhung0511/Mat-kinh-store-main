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
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('discount_id');
            $table->unsignedInteger('product_id');
            $table->string('discount_name');
            $table->string('discount_code');
            $table->string('discount_percent');
            $table->integer('discount_status');
            $table->date('start_date');
            $table->date('end_date');

            $table->foreign('product_id')->references('product_id')->on('product');   // Đinh nghĩa khóa ngoại của bảng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
