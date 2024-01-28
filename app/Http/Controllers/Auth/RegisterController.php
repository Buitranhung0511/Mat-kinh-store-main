<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\UserProfile;
class RegisterController extends Controller
{
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Tạo thông tin profile
        UserProfile::create([
            'user_id' => $user->id,
            'customer_name' => $data['name'],
            'customer_email' => $data['email'],
            'customer_phone' => '',
            'customer_address' => '',
        ]);

        return $user;
}
}
