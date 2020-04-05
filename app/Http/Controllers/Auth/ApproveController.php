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

        $user->is_approved = $approve;
        $user->save();

        if ($approve) {
            Mail::to($user->email)->send(new AccountApprovalMail($user));
        } else {
            $user->delete();
        }

        return redirect()->back();
    }
}
