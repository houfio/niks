<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function resetPassword(ForgotPasswordRequest $request)
    {
        $response = $this->broker()->sendResetLink($this->credentials($request));

        if ($response === Password::RESET_LINK_SENT) {
            $request->session()->flash('success', __('forgotPassword.successStatus'));
            return $this->sendResetLinkResponse($request, $response);
        } else {
            $request->session()->flash('error', __('forgotPassword.unsuccessfulStatus'));
            return $this->sendResetLinkFailedResponse($request, $response);
        }
    }
}
