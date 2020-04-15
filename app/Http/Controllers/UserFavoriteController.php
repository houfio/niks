<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\User;
use App\UserFavorite;

class UserFavoriteController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(UserFavorite::class, 'userfavorite');
    }

    public function index()
    {

    }

    public function store(FavoriteRequest $request)
    {

    }

    public function destroy(UserFavorite $userFavorite)
    {

    }
}
