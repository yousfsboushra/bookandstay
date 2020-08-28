<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    protected $fillable = ['name'];

    /**
     * The rooms that belong to the advertiser.
     */
    public function rooms(){
        return $this->belongsToMany('App\Room')->withPivot('net_price', 'total_price');
    }
}
