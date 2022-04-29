<?php

namespace App;

use App\Apartment;
use Illuminate\Database\Eloquent\Model;

class ApartmentView extends Model
{
    public function apartmentView()
    {
        return $this->belongsTo(Apartment::class);
    }

    public static function createViewLog($apartment) {
        $apartmentViews= new ApartmentView();
        $apartmentViews->apartment_id = $apartment->id;
        $apartmentViews->slug = $apartment->slug;
        $apartmentViews->url = request()->url();
        $apartmentViews->session_id = request()->getSession()->getId();
        $apartmentViews->user_id = (auth()->check())?auth()->id():null; 
        $apartmentViews->ip = request()->ip();
        $apartmentViews->agent = request()->header('User-Agent');
        $apartmentViews->save();
    }
}
