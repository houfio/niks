<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Bid;
use App\Http\Requests\BidRequest;
use Exception;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Bid::class, 'bid');
    }

    public function store(BidRequest $request, Advertisement $advertisement)
    {
        $data = $request->validated();
        $bid = new Bid();

        $bid->bid = $data['bid'];

        $bid->advertisement()->associate($advertisement);
        $bid->user()->associate($request->user());

        $bid->save();
        $request->session()->flash('message', __('messages/bid.sent'));

        return redirect()->action('AdvertisementController@show', ['advertisement' => $advertisement->id]);
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, Bid $bid)
    {
        $bid->delete();
        $request->session()->flash('message', __('messages/bid.deleted'));

        return redirect()->back();
    }
}
