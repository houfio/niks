<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\User;
use App\UserFavorite;
use Illuminate\Http\Request;

class UserFavoritesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(UserFavorite::class, 'userfavorite');
    }

    public function index(Request $request)
    {
        return view('favorites.index', [
            'favorites' => $request->user()->favorites()->orderBy('user_favorites.created_at', 'desc')->paginate()
        ]);
    }

    public function store(FavoriteRequest $request)
    {
        $data = $request->validated();

        $user = $request->user();
        $user->favorites()->attach($data['advertisement']);

        $request->session()->flash('message', __('messages/favorite.saved'));

        return redirect()->back();
    }

    public function destroy(Request $request, UserFavorite $userFavorite)
    {
        $userFavorite->delete();
        $request->session()->flash('message', __('messages/favorite.deleted'));

        return redirect()->back();
    }
}
