<?php

namespace App;

use App\ApartmentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "title", "description", "room_numbers", "bed_numbers",
        "bathroom_numbers", "square_meters", "cover", "price_per_night", "country",
        "region", "province", "streetAddress", "latitude", "longitude", 'isVisible'
    ];
    //Collegamenti di cui fa parte

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function sponsorships()
    {
        return $this->belongsToMany('App\Sponsorship');
    }

    //Collegamenti che possiede

    public function statistics()
    {
        return $this->hasMany('App\Statistic');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function apartmentView()
    {
        return $this->hasMany(ApartmentView::class);
    }

    public function showApartment()
    {
        if(auth()->id()==null){
            return $this->apartmentView()
            ->where('ip', '=',  request()->ip())->exists();
        }

        return $this->apartmentView()
        ->where(function($apartmentViewsQuery) { $apartmentViewsQuery
            ->where('session_id', '=', request()->getSession()->getId())
            ->orWhere('user_id', '=', (auth()->check()));})->exists();
    }
}
