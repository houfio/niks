<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Bid;
use App\Http\Requests\BidRequest;
use Exception;

class BidController extends Controller
{
    public function store(BidRequest $request, Advertisement $advertisement)
    {
        $data = $request->validated();
        $bid = new Bid();

        $bid->bid = $data['bid'];

        $bid->advertisement()->associate($advertisement);
        $bid->user()->associate($request->user());

        $bid->save();

        return redirect("/advertisements/$advertisement->id");
    }

    /**
     * @param Bid $bid
     * @throws Exception
     */
    public function destroy(Bid $bid)
    {
        $bid->delete();
    }
}
