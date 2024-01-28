<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(Blueprint $table): void
    // {

    //     $table->increments('customer_id');
    //         $table->string('customer_name');
    //         $table->string('customer_email')->nullable();
    //         $table->string('customer_password');
    //         $table->string('customer_phone');
    //         $table->string('customer_address');
    //         $table->timestamps();
    // }
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->string('customer_name');
            $table->string('customer_email')->unique();
            $table->string('customer_password');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('customer_gender'); // Thêm cột giới tính
            $table->date('customer_dob'); // Thêm cột ngày sinh
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
