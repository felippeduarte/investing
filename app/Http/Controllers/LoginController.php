<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json([], 200);
        }
        return response()->json([], 401);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([], 200);
    }
}