<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAccount;
use App\Mail\AccountRequestedMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    public function create(RequestAccount $request)
    {
        $data = $request->validated();

        $user = new User();

        $user->email = $data['email'];
        $user->first_name = $data['firstName'];
        $user->middle_name = $data['middleName'];
        $user->last_name = $data['lastName'];

        $user->save();

        Mail::to($user->email)->send(new AccountRequestedMail($user));

        return view('welcome');
    }
}
