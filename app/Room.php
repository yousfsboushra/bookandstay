<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model{
    protected $fillable = ['name', 'code', 'hotel_id'];

    /**
     * Get the room hotel.
     */
    public function hotel(){
        return $this->belongsTo('App\Hotel');
    }

    /**
     * The advertisers that belong to the room.
     */
    public function advertisers(){
        return $this->belongsToMany('App\Advertiser')->withPivot('net_price', 'total_price');
    }
}
