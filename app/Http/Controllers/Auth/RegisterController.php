<?php

namespace App\Http\Controllers\Auth;;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = new User();

        $user->email = $data['email'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->zip_code = $data['zip_code'];
        $user->phone_number = $data['phone_number'];
        $user->house_number = $data['house_number'];
        $user->motivation = $data['motivation'];

        $user->save();
        $request->session()->flash('message', __('messages/register.sent'));

        Mail::to($user->email)->send(new RegisterMail($user));

        return redirect()->route('home');
    }
}
