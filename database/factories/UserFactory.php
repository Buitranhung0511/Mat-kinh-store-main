<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Roles;
use Faker\Generator as Faker;
use Illuminate\Support\Testing\Fakes\Fake;


class UserFactory extends Factory
{
  
    protected static ?string $password;

  
    
     public function definition()
     {
         return [
             'admin_name' => $this->faker->name(),
             'admin_email' => $this->faker->unique()->safeEmail(),
             'admin_phone' => '0799218799',
             'admin_password' => 'e10adc3949ba59abbe56e057f20f883e',
         ];
     }


     public function configure()
     {
         return $this->afterCreating(function (Admin $admin, Faker $faker) {
             $roles = Roles::where('name', 'user')->get();
             $admin->roles()->sync($roles->pluck('id_roles')->toArray());
         });
     }



    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
