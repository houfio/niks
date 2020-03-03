<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterMail;
use App\User;
use Exception;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function request(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = new User();

        $user->email = $data['email'];
        $user->first_name = $data['firstName'];
        $user->last_name = $data['lastName'];
        $user->zip_code = $data['zipCode'];
        $user->phone_number = $data['phoneNumber'];
        $user->house_number = $data['houseNumber'];

        $user->save();

        try {
            Mail::to($user->email)->send(new RegisterMail($user));
        } catch (Exception $exception) {
            return redirect('/');
        }

        return redirect('/');
    }
}
