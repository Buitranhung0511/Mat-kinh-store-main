<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));
    }


    public function add_users()
    {
        return view('admin.users.add_users');
    }


    public function assign_roles(Request $request)
    {
        $data = $request->all();
        $user = Admin::where('admin_email', $data['admin_email'])->first();
        $user->roles()->detach();
        if ($request['author_role']) {
            $user->roles()->attach(Roles::where('name', 'author')->first());
        }
        if ($request['user_role']) {
            $user->roles()->attach(Roles::where('name', 'user')->first());
        }
        if ($request['admin_role']) {
            $user->roles()->attach(Roles::where('name', 'admin')->first());
        }
        return redirect()->back()->with('messsage', 'Cap Quyen Thanh Cong');
    }
}