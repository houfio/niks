<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
use App\Http\Requests\AdvertisementRequest;
use App\Services\LocationService;
use App\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    private LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;

        $this->authorizeResource(Advertisement::class, 'advertisement');
    }

    public function index(Request $request)
    {
        $queries = $request->query();

        $advertisements = new Advertisement();
        $advertisements = $advertisements->newQuery();

        if (isset($queries['search'])) {
            $advertisements = $advertisements->where(function ($query) use ($queries) {
                $query->where('title', 'like', "%{$queries['search']}%")
                    ->orWhere('short_description', 'like', "%{$queries['search']}%")
                    ->orWhere('long_description', 'like', "%{$queries['search']}%");
            });
        }

        if (isset($queries['price'])) {
            $advertisements = $advertisements->where(function ($query) use ($queries) {
                $query->where('price','<=', (int)$queries['price'])
                    ->orWhere('minimum_price', '<=', (int)$queries['price']);
            });
        }

        if (isset($queries['bidding'])) {
            $advertisements = $advertisements->where(function ($query) use ($queries) {
                $query->where('enable_bidding', (int)$queries['bidding']);
            });
        }

        if (isset($queries['distance'])) {
            $distance = (int)$queries['distance'];

            $advertisements->join('users as u', 'advertisements.user_id', '=', 'u.id');
            $advertisements = $advertisements->where(function ($query) use ($queries, $request, $distance) {
                $query->whereRaw("ROUND(ST_Distance_Sphere(
                     point(?, ?),
                     point(u.longitude, u.latitude)
                 ) / 1000, 2) <= ?", [
                    $request->user()->longitude,
                    $request->user()->latitude,
                    $distance
                ]);
            });
        }

        return view('advertisement.index', [
            'advertisements' => $advertisements->paginate(10)
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
        $advertisement->is_asking = isset($data['is_asking']);

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
            'bids' => $advertisement->bids()->get(),
            'favorite' =>  UserFavorite::where('user_id', Auth::user()->id)->where('advertisement_id', $advertisement->id)->first()
        ]);
    }

    public function edit(Advertisement $advertisement)
    {
        return view('advertisement.update', [
            'advertisement' => $advertisement,
            'assets' => $advertisement->assets()->get()
        ]);
    }

    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $data = $request->validated();

        $advertisement->title = $data['title'];
        $advertisement->short_description = $data['short_description'];
        $advertisement->long_description = $data['long_description'];
        $advertisement->price = $data['price'];
        $advertisement->enable_bidding = isset($data['enable_bidding']);
        $advertisement->minimum_price = $data['minimum_price'];
        $advertisement->is_service = $data['is_service'];
        $advertisement->is_asking = isset($data['is_asking']);

        $advertisement->user()->associate($request->user());

        if(!isset($data['delete_images'])) {
            $advertisement->assets()->detach();

            if (isset($data['images'])) {
                $assets = [];
                foreach ($data['images'] as $image) {
                    $asset = new Asset();

                    $asset->path = $image->store('public');

                    $asset->save();
                    $assets[] = $asset;
                }
            }
        }

        $advertisement->save();
        if(isset($data['images'])) {
            $advertisement->assets()->saveMany($assets);
        }
        $request->session()->flash('message', __('messages/advertisement.updated'));

        return redirect()->route('advertisements.show', $advertisement->id);
    }
}
