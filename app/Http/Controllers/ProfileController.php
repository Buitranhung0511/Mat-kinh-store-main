<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
class ProfileController extends Controller
{
    public function showProfile($userId)
    {
        $userProfile = UserProfile::where('user_id', $userId)->get();
        return redirect('show', compact('userProfile'));
    }
}
