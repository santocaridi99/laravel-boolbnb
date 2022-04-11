<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{

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
