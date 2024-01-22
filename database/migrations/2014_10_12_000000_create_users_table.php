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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->renameColumn('id', 'user_id');
            $table->renameColumn('name', 'user_name');
            $table->renameColumn('email', 'user_email');
            $table->renameColumn('phone', 'user_phone', 30)->unique()->nullable();
            $table->renameColumn('email_verified_at', 'user_email_verified_at')->nullable();
            $table->renameColumn('password', 'user_password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
            $table->renameColumn('user_name', 'name');
            $table->renameColumn('user_email', 'email');
            $table->renameColumn('user_phone', 'phone');
            $table->renameColumn('user_email_verified_at', 'email_verified_at');
            $table->renameColumn('user_password', 'password');
        });
    }
};
