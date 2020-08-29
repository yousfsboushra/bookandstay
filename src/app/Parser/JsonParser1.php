<?php

namespace App\Parser;

Class JsonParser1 implements Parser{
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
                        $hotelObject = \App\Models\Hotel::createInstance($hotel->name, $hotel->stars);
                        \App\Models\Room::createInstance($room->name, $room->code, $hotelObject, $room->totalPrice, $sourceName);
                    }
                }
            }
        }
        return $rooms;
    }
}