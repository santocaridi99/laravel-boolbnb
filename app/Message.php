<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "name", "lastname", "content", 'apartment_id', 'email'
    ];
    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }
}
