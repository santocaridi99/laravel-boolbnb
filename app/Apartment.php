<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        "title", "description", "room_numbers", "bed_numbers",
        "bathroom_numbers", "square_meters", "cover", "price_per_night", "country",
        "region", "province", "city", "street", "street_number", "post_code" /*,  "images" */
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
}
