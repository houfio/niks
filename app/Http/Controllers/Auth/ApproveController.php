<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveAccountRequest;
use App\Mail\AccountApprovalMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class ApproveController extends Controller
{
    public function approve(ApproveAccountRequest $request)
    {
        $data = $request->validated();

        $approve = boolval($data['approve']);

        $user = User::find('email', $data['email']);
        $user->is_approved = $approve;
        $user->save();

        if ($approve) {
            Mail::to($user->email)->send(new AccountApprovalMail($user));
        }

        return redirect('/');
    }
}
