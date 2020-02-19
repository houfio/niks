<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestAccount;
use App\User;

class AccountController extends Controller
{
    public function create(RequestAccount $request)
    {
        $validatedRequest = $request->validated();

        $user = new User();

        $user->email = $validatedRequest['email'];
        $user->first_name = $validatedRequest['firstName'];
        $user->middle_name = $validatedRequest['middleName'];
        $user->last_name = $validatedRequest['lastName'];

        $user->save();

        return view('welcome');
    }
}
