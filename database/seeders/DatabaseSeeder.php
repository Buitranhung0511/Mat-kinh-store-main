<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use Carbon\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use App\Models\Rating;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
       

        $this->call(UsersTableSeeder::class); //gọi đến class của seeder Users 
        // sau đó chạy câu lên "php artisan db:seed" để đưa dữ liệu vào database




        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
            // factory(App\Models\Admin::class,20)->create();
    }
}