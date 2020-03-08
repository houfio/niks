<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveAccountRequest;
use App\Mail\AccountApprovalMail;
use App\User;
use Exception;
use Illuminate\Support\Facades\Mail;

class ApproveController extends Controller
{
    public function approve(ApproveAccountRequest $request)
    {
        $data = $request->validated();

        $approve = boolval($data['approve']);

        $user = User::find('email', $data['email']);
        $user->approved = $approve;
        $user->save();

        try {
            if($approve) {
                Mail::to($user->email)->send(new AccountApprovalMail($user));
            }
        } catch (Exception $exception) {
            return redirect('/');
        }

        return redirect('/');
    }
}
