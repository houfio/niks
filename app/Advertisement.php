<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisements';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'advertisement_assets');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'advertisement_categories');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_favorites')->using(UserFavorite::class);
    }

    public function cost(): ?int
    {
        return $this->enable_bidding ? $this->highestBid() : $this->price;
    }

    private function highestBid(): ?int
    {
        if (!$this->enable_bidding) {
            return 0;
        }

        $highestBid = $this->bids()->max('bid');

        return is_null($highestBid) ? $this->price : $highestBid;
    }
}
