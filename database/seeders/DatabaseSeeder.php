<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class); //gọi đến class của seeder Roles 
        // sau đó chạy câu lên "php artisan db:seed" để đưa dữ liệu vào database


        $this->call(UsersTableSeeder::class); //gọi đến class của seeder Roles 
        // sau đó chạy câu lên "php artisan db:seed" để đưa dữ liệu vào database




        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
