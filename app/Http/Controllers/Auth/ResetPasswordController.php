<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\PasswordReset;
use App\Providers\RouteServiceProvider;
use App\User;
use DateTime;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function reset(ResetPasswordRequest $request, string $token)
    {
        $data = $request->validated();

        $passwordReset = PasswordReset::where('email', $request['email'])->first();
        $validateToken = Hash::check($token, $passwordReset->token);

        if (!$validateToken || $this->tokenExpired($passwordReset)) {
            return redirect("/reset/$token")
                ->withErrors([
                    'resetPassword.tokenExpired'
                ]);
        }

        $user = User::where('email', $passwordReset->email)->first();
        $this->resetPassword($user, $data['password']);

        return redirect('/home');
    }

    private function tokenExpired(PasswordReset $passwordResetData): bool
    {
        $currentDate = new DateTime();
        return $currentDate >= $passwordResetData->created_at->modify('+1 day');
    }
}
