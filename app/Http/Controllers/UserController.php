<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

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

    public function edit(User $user)
    {
        return view('user.update', [
            'user' => $user
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->email = $data['email'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->zip_code = $data['zip_code'];
        $user->phone_number = $data['phone_number'];
        $user->house_number = $data['house_number'];
        $user->neighbourhood = $data['neighbourhood'];

        if (Gate::forUser($request->user())->allows('edit-protected-user-values')) {
            $user->is_approved = isset($data['is_approved']);
            $user->is_admin = isset($data['is_admin']);
        }

        $user->save();
        $request->session()->flash('message', __('messages/user.updated'));

        return redirect()->action('UserController@index');
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash('message', __('messages/user.deleted'));

        return redirect()->action('UserController@index');
    }
}
