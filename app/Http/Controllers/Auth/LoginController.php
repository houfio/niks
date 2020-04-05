<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ThrottlesLogins;

    protected int $maxAttempts = 3;
    protected int $decayMinutes = 10;

    protected function username()
    {
        return 'email';
    }

    public function login(Request $request)
    {
        $rememberMe = boolval($request->get('remember'));
        $password = $request->get('password');
        $email = $request->get('email');

        $tooMany = $this->hasTooManyLoginAttempts($request);

        if (!$tooMany && Auth::attempt(['password' => $password, 'email' => $email, 'is_approved' => 1], $rememberMe)) {
            $this->clearLoginAttempts($request);
            return redirect('/');
        } else {
            $this->incrementLoginAttempts($request);
            $user = User::firstWhere('email', $email);

            if (is_null($user) || !$user->is_approved) {
                $error = 'views/login.invalid_login';
            } elseif ($tooMany) {
                $error = 'views/login.timeout';
            } else {
                $error = 'views/login.invalid_login';
            }

            return redirect('/login')
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $error
                ]);
        }
    }
}
