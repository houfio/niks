<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ThrottlesLogins;

    protected int $maxAttempts = 3;
    protected int $decayMinutes = 10;

    protected function username()
    {
        return 'email';
    }

    public function authenticate(Request $request)
    {
        $rememberMe = boolval($request->get('remember'));
        $password = $request->get('password');
        $email = $request->get('email');

        $this->incrementLoginAttempts($request);

        if (!$this->hasTooManyLoginAttempts($request) && Auth::attempt(['password' => $password, 'email' => $email, 'approved' => 1], $rememberMe)) {
            $this->clearLoginAttempts($request);
            return redirect('/');
        } else {
            return redirect('/login')
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'login.invalid_login'
                ]);
        }
    }
}
