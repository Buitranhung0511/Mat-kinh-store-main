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
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->string('comment');
            $table->string('comment_name');
            $table->string('comment_email')->unique();
            $table->timestamp('comment_date');
            $table->integer('comment_status');
            $table->unsignedInteger('product_id');


            $table->foreign('product_id')->references('product_id')->on('product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
