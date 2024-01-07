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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->text('sumary')->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('category_id');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('category_id')->references('category_id')->on('category_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
