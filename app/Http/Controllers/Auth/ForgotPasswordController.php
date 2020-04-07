<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function sendPasswordSetupMail(User $user)
    {
        $this->broker()->sendResetLink(['email' => $user->email]);

        $user->is_approved = true;

        $user->save();

        return redirect()->action('UserController@index');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $this->passwordReset($this->broker()->sendResetLink($this->credentials($request)), $request);
    }

    private function passwordReset(string $response, ForgotPasswordRequest $request)
    {
        if ($response === Password::RESET_LINK_SENT) {
            $request->session()->flash('message', __('views/forgotPassword.successStatus'));

            return $this->sendResetLinkResponse($request, $response);
        } else {
            $request->session()->flash('message', __('views/forgotPassword.unsuccessfulStatus'));

            return $this->sendResetLinkFailedResponse($request, $response);
        }
    }
}
