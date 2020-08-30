<?php
declare(strict_types=1);

namespace App\Parser;

use App\Models\Hotel;
use App\Models\Room;

Class JsonParser2 implements Parser{
    private static $instance = null;

    private function __construct(){}

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function parseRooms($json, $sourceName){
        $rooms = array();
        $data = json_decode($json);
        if(!empty($data->hotels)){
            foreach($data->hotels as $hotel){
                if(!empty($hotel->rooms)){
                    foreach($hotel->rooms as $room){
                        $hotelObject = Hotel::createInstance($hotel->name, $hotel->stars);
                        Room::createInstance($room->name, $room->code, $hotelObject, floatval($room->totalPrice), $sourceName);
                    }
                }
            }
        }
        return $rooms;
    }
}