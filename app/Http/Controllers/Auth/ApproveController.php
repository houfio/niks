<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveAccountRequest;
use App\Mail\AccountApprovalMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class ApproveController extends Controller
{
    public function approve(ApproveAccountRequest $request, User $user)
    {
        $data = $request->validated();
        $approve = boolval($data['approve']);

        if ($approve) {
            return redirect()->action('Auth\ForgotPasswordController@sendPasswordSetupMail', ['user' => $user->id]);
        }

        $user->delete();
        $request->session()->flash('message', __('messages/user.deleted'));

        return redirect()->back();
    }
}
