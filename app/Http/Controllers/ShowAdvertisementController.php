<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
use App\User;
use Illuminate\Http\Request;

class ShowAdvertisementController extends Controller
{
    public function showInformation(Advertisement $advertisement)
    {
        return view('advertisement.show', [
            'advertisement' => $advertisement,
            'user' => $advertisement->user()->get()[0],
            'assets' => $advertisement->assets()->get()
        ]);
    }
}
