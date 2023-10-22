<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\StatusCode;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        // dd($request->all());
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($arr)) {
            $user = Auth::user();
            if ($user->role->value == UserRole::SUPER_ADMIN || $user->role->value == UserRole::ADMIN || $user->role->value == UserRole::MANAGER) {
                return response()->json(['success' => true], StatusCode::OK);
            } else {
                // Người dùng thông thường
                return response()->json(['error' => false], StatusCode::OK);
            }
        } else {
            dd('Tài khoản và mật khẩu không chính xác.');
        }
    }

    public function logout(){
        $user = Auth::logout();
        return response()->json(['success' => true], StatusCode::OK);
    }
}
