<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // if (Auth::check() && Auth::user()->isAdmin()) {
        //     return $next($request);
        // }
        $user = Auth::user();
        if($user->role->value == UserRole::SUPER_ADMIN || $user->role->value == UserRole::ADMIN || $user->role->value == UserRole::MANAGER){
            return $next($request);
        }

        return redirect('/admin/login'); // Điều hướng đến trang đăng nhập nếu không có quyền Admin
    }
}
