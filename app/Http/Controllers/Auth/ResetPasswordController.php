<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\PasswordReset;
use App\Providers\RouteServiceProvider;
use App\User;
use DateTime;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function reset(ResetPasswordRequest $request, string $token)
    {
        $data = $request->validated();

        $passwordReset = PasswordReset::where('token', $token)->take(1)->get();
        $currentDate = new DateTime();

        if ($passwordReset->createdAt->modify('+1 day') >= $currentDate) {
            return redirect('/reset')
                ->withErrors([
                    'resetPassword.tokenExpired'
                ]);
        }

        $user = User::where('email', $passwordReset->email)->take(1)->get();
        $this->resetPassword($user, $data['password']);

        return redirect('/home');
    }
}
