<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountFormRequest;
use App\Mail\AccountRequestedMail;
use App\User;
use Exception;
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

        $user->save();

        try {
            Mail::to($user->email)->send(new AccountRequestedMail($user));
        } catch (Exception $exception) {
            return view('welcome');
        }

        return view('welcome');
    }
}
