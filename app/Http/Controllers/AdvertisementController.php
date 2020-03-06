<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
use App\Http\Requests\CreateAdvertisementRequest;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function create(CreateAdvertisementRequest $request)
    {
        $data = $request->validated();

        $advertisement = new Advertisement();

        $advertisement->title = $data['title'];
        $advertisement->short_description = $data['short_description'];
        $advertisement->long_description = $data['long_description'];
        $advertisement->price = $data['price'];
        $advertisement->enable_bidding = $data['enable_bidding'];
        $advertisement->minimum_price = $data['minimum_price'];
        $advertisement->is_service = $data['is_service'];
        $advertisement->asking = $data['asking'];

        $advertisement->user()->associate($request->user());
        $assets = [];

        foreach ($data['images'] as $image) {
            $asset = new Asset();

            $asset->path = Storage::put('advertisements', $image);

            $asset->save();
            $assets[] = $asset;
        }

        $advertisement->assets()->saveMany($assets);
        $advertisement->save();
    }
}
