<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
use App\Http\Requests\CreateAdvertisementRequest;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Advertisement::class, 'advertisement');
    }

    public function index()
    {
        return view('advertisement.index');
    }

    public function create()
    {
        return view('advertisement.create');
    }

    public function store(CreateAdvertisementRequest $request)
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

        foreach ($data['images'] as $image) {
            $asset = new Asset();

            $asset->path = Storage::put('advertisements', $image);

            $asset->save();
            $assets[] = $asset;
        }
        $advertisement->save();
        $advertisement->assets()->saveMany($assets);

        return redirect('/');
    }

    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

        return redirect('/');
    }

    public function show(Advertisement $advertisement)
    {
        return view('advertisement.show', [
            'advertisement' => $advertisement,
            'user' => $advertisement->user()->get()[0],
            'assets' => $advertisement->assets()->get()
        ]);
    }
}
