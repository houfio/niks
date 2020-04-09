<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
use App\Http\Requests\AdvertisementRequest;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Advertisement::class, 'advertisement');
    }

    public function index()
    {
        $advertisements = Advertisement::paginate(10);

        return view('advertisement.index', [
            'advertisements' => $advertisements
        ]);
    }

    public function create()
    {
        return view('advertisement.create');
    }

    public function store(AdvertisementRequest $request)
    {
        $data = $request->validated();

        $advertisement = new Advertisement();

        $advertisement->title = $data['title'];
        $advertisement->short_description = $data['short_description'];
        $advertisement->long_description = $data['long_description'];
        $advertisement->price = $data['price'];
        $advertisement->enable_bidding = isset($data['enable_bidding']);
        $advertisement->minimum_price = $data['minimum_price'];
        $advertisement->is_service = $data['is_service'];
        $advertisement->asking = isset($data['asking']);

        $advertisement->user()->associate($request->user());
        $assets = [];

        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $asset = new Asset();

                $asset->path = $image->store('public');

                $asset->save();
                $assets[] = $asset;
            }
        }

        $advertisement->save();
        $advertisement->assets()->saveMany($assets);
        $request->session()->flash('message', __('messages/advertisement.sent'));

        return redirect()->action('AdvertisementController@index');
    }

    public function destroy(Request $request, Advertisement $advertisement)
    {
        $advertisement->delete();
        $request->session()->flash('message', __('messages/advertisement.deleted'));

        return redirect()->action('AdvertisementController@index');
    }

    public function show(Advertisement $advertisement)
    {
        return view('advertisement.show', [
            'advertisement' => $advertisement,
            'user' => $advertisement->user()->get()->first(),
            'assets' => $advertisement->assets()->get(),
            'bids' => $advertisement->bids()->get()
        ]);
    }
}
