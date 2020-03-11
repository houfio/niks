<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        return view('user.index', [
            'users' => User::all()
        ]);
    }

    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('user.update', [
            'user' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->email = $data['email'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->zip_code = $data['zip_code'];
        $user->phone_number = $data['phone_number'];
        $user->house_number = $data['house_number'];
        $user->neighbourhood = $data['neighbourhood'];

        if (Gate::forUser($user)->allows('edit-protected-user-values')) {
            $user->is_admin = $data['is_admin'];
            $user->approved = $data['approved'];
        }

        $user->save();

        return redirect("/users/$user->id/edit");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users');
    }
}
