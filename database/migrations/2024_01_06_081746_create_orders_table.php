<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
          * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('product_price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->text('shipping_address');
            $table->string('shipping_method', 100);
            $table->date('expected_delivery_date');
            $table->string('payment_method', 50);
            $table->string('payment_status', 50);
            $table->string('order_status', 50);
            $table->timestamps();
            $table->text('additional_notes')->nullable();
            $table->string('discount_code', 20)->nullable();
            $table->decimal('total_discount', 10, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->unsignedBigInteger('user_account_id')->nullable();
            $table->string('refund_status', 50)->nullable();
            $table->text('refund_notes')->nullable();

            $table->integer('user_account_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};