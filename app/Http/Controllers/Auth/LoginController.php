<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $rememberMe = boolval($request->get('rememberMe'));
        $password = $request->get('password');
        $email = $request->get('email');

        if (Auth::attempt(['password' => $password, 'email' => $email, 'approved' => 1], $rememberMe)) {
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }
}
