<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name', 'stars'];

    /**
     * Get the rooms of the hotel.
     */
    public function rooms(){
        return $this->hasMany('App\Room');
    }
}
