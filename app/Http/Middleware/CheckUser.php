<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (optional(Auth::user())->hasRole('user')) {
            return $next($request);
        }

        // Nếu không phải admin, bạn có thể xử lý nó ở đây, ví dụ chuyển hướng người dùng
        return redirect('/dashboard')->with('error', 'Unauthorized access');
    }
}
