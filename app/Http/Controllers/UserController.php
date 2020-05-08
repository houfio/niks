<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
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

    public function index(Request $request)
    {
        $queries = $request->query();
        $users = User::query();

        if (isset($queries['search'])) {
            $users = $users->where(function ($query) use ($queries) {
                $query->where('email', 'like', "%{$queries['search']}%")
                    ->orWhereRaw('concat(first_name, " ", last_name) LIKE ?', [
                        "%{$queries['search']}%"
                    ]);
            });
        }

        if (isset($queries['sort']) && ($queries['sort'] === 'first_name' || $queries['sort'] === 'last_name' || $queries['sort'] === 'email')) {
            $users = $users->orderBy($queries['sort'], isset($queries['direction']) && $queries['direction'] === 'desc' ? 'desc' : 'asc');
        } else {
            $users = $users->orderBy('created_at', 'desc');
        }

        return view('user.index', [
            'users' => $users->paginate()
        ]);
    }

    public function show(User $user)
    {
        $advertisements = Advertisement::where('user_id', $user->id)->paginate();

        return view('user.show', [
            'user' => $user,
            'advertisements' => $advertisements
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

        if ($request->hasFile('avatar')) {
            $asset = new Asset();

            $asset->path = $request->avatar->store('public');

            $asset->save();
            $user->avatar()->associate($asset);
        }

        if ($request->hasFile('header')) {
            $asset = new Asset();

            $asset->path = $request->header->store('public');

            $asset->save();
            $user->header()->associate($asset);
        }

        if (Gate::allows('edit-all')) {
            $user->is_approved = isset($data['is_approved']);
            $user->is_admin = isset($data['is_admin']);
        }

        $user->save();
        $request->session()->flash('message', __('messages/user.updated'));

        if (Gate::allows('edit-all')) {
            return redirect()->action('UserController@index');
        }

        return redirect()->action('UserController@show', ['user' => $user]);
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
