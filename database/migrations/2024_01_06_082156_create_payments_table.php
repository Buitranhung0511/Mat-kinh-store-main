<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->string('partnerCode');
            $table->string('accessKey');
            $table->string('requestId');
            $table->decimal('amount', 10, 2);
            $table->string('orderId');
            $table->text('orderInfo')->nullable();
            $table->string('orderType');
            $table->string('transId');
            $table->string('localMessage');
            $table->string('responseTime');
            $table->string('payType');
            $table->string('signature');
            // Assuming 'transId' is the primary key
            $table->primary('transId');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment');
    }
};