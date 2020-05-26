<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Asset;
use App\Category;
use App\Http\Requests\AdvertisementRequest;
use App\UserFavorite;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Advertisement::class, 'advertisement');
    }

    public function index(Request $request)
    {
        $queries = $request->query();
        $advertisements = Advertisement::query();

        if (isset($queries['search'])) {
            $advertisements = $advertisements->where(function ($query) use ($queries) {
                $query->where('title', 'like', "%{$queries['search']}%")
                    ->orWhere('short_description', 'like', "%{$queries['search']}%")
                    ->orWhere('long_description', 'like', "%{$queries['search']}%");
            });
        }

        if (isset($queries['price'])) {
            $advertisements = $advertisements->where('price', '<=', (int)$queries['price'])
                ->where('enable_bidding', '=', 0);
        }

        if (isset($queries['bidding'])) {
            $advertisements = $advertisements->where('enable_bidding', '=', $queries['bidding'] === 'on');
        }

        if (isset($queries['distance'])) {
            $distance = (int)$queries['distance'];
            $advertisements->join('users as u', 'advertisements.user_id', '=', 'u.id')
                ->where(function ($query) use ($queries, $request, $distance) {
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

        if (isset($queries['categories'])) {
            $categories = $queries['categories'];
            $categories = Category::whereIn('id', $categories)->get();
            $categoryIds = [];

            foreach ($categories as $category) {
                $categoryIds[] = $category->id;

                foreach ($category->children()->get()->pluck('id')->toArray() as $subCategory) {
                    $categoryIds[] = $subCategory;
                }
            }

            $advertisements->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            });
        }

        return view('advertisement.index', [
            'advertisements' => $advertisements->paginate(),
            'categories' => Category::getAdvertisementCategories()
        ]);
    }

    public function create()
    {
        return view('advertisement.create', [
            'categories' => Category::getAdvertisementCategories()
        ]);
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
        $advertisement->categories()->attach($data['categories'] ?? []);
        $request->session()->flash('message', __('messages/advertisement.sent'));

        return redirect()->action('AdvertisementController@index');
    }

    public function destroy(Request $request, Advertisement $advertisement)
    {
        $advertisement->delete();
        $request->session()->flash('message', __('messages/advertisement.deleted'));

        return redirect()->action('AdvertisementController@index');
    }

    public function show(Request $request, Advertisement $advertisement)
    {
        return view('advertisement.show', [
            'advertisement' => $advertisement,
            'user' => $advertisement->user()->get()->first(),
            'assets' => $advertisement->assets()->get(),
            'bids' => $advertisement->bids()->get(),
            'favorite' => UserFavorite::where('user_id', $request->user()->id)->where('advertisement_id', $advertisement->id)->first()
        ]);
    }

    public function edit(Advertisement $advertisement)
    {
        return view('advertisement.update', [
            'advertisement' => $advertisement,
            'assets' => $advertisement->assets()->get(),
            'categories' => Category::getAdvertisementCategories()
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
        $advertisement->is_service = $data['is_service'];
        $advertisement->is_asking = isset($data['is_asking']);

        $advertisement->categories()->sync($data['categories'] ?? []);
        $advertisement->user()->associate($request->user());
        $advertisement->assets()->sync($data['existing_images'] ?? []);

        if (isset($data['images'])) {
            $assets = [];

            foreach ($data['images'] as $image) {
                $asset = new Asset();

                $asset->path = $image->store('public');

                $asset->save();
                $assets[] = $asset;
            }
        }

        $advertisement->save();

        if (isset($data['images'])) {
            $advertisement->assets()->saveMany($assets);
        }

        $request->session()->flash('message', __('messages/advertisement.updated'));

        return redirect()->route('advertisements.show', $advertisement->id);
    }
}
