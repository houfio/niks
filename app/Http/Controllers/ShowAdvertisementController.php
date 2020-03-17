<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
use App\User;
use Illuminate\Http\Request;

class ShowAdvertisementController extends Controller
{
    public function showInformation(){

//        $data = DB::table('advertisements')
//            ->join('advertisement_asset', 'advertisements.id', '=', 'advertisement_asset.advertisement_id')
//            ->join('assets', 'advertisement_asset.asset_id' , '=', 'assets.id')
//            ->join('users', 'users.id','=','advertisements.user_id')
//            ->select()
//            ->get();

//        return view(selectedadvertisement, compact('data'));
//        $advertisement = Advertisement::where('id', '3')->get();
//        return view('selectedadvertisement', ['advertisement'=>$advertisement ]);

//        $advertisement = Advertisement::find(1)->assets;
//        $advertisement = Advertisement::find(1)->user;
//        $advertisement = Advertisement::where('id', '3')->get();
        $advertisement = Advertisement::where('id', '3')->get();
        $user = User::where('id', '3')->get();
        $asset = Asset::where('id', '3')->get();

//        $asset = Asset::where('advertisement_id', '=', '3')->get();

//        return view('selectedadvertisement', compact('asset','advertisement', 'user'));
        return view('selectedadvertisement')->with('asset', $asset)->with('advertisement', $advertisement)->with('user', $user);
//        return view('selectedadvertisement', ['advertisement'=>$advertisement ]);
    }
}
