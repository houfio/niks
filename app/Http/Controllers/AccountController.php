<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountFormRequest;
use App\Mail\AccountRequestedMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    public function create(AccountFormRequest $request)
    {
        $data = $request->validated();

        $user = new User();

        $user->email = $data['email'];
        $user->first_name = $data['firstName'];
        $user->last_name = $data['lastName'];
        $user->zip_code = $data['zipCode'];
        $user->neighbourhood = $data['neighbourhood'];
        $user->phone_number = $data['phoneNumber'];
        $user->house_number = $data['houseNumber'];

        $user->save();

        Mail::to($user->email)->send(new AccountRequestedMail($user));

        return redirect('/');
    }

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

    public function setPassword(SetPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::find('email', $data['email']);
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect('/');
    }
}
