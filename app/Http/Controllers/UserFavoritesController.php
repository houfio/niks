<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\UserFavorite;
use Illuminate\Http\Request;

class UserFavoritesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(UserFavorite::class, 'favorite');
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

        $hasFavorited = UserFavorite::where('user_id', $request->user()->id)->where('advertisement_id', (int)$data['advertisement'])->count();

        if ($hasFavorited) {
            return redirect()->back();
        }

        $user = $request->user();
        $user->favorites()->attach($data['advertisement']);

        $request->session()->flash('message', __('messages/favorite.saved'));

        return redirect()->back();
    }

    public function destroy(Request $request, UserFavorite $favorite)
    {
        $favorite->delete();
        $request->session()->flash('message', __('messages/favorite.deleted'));

        return redirect()->back();
    }
}
