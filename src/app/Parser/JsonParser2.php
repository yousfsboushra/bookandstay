<?php

namespace App\Parser;

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
                        $rooms[str_replace(" ", "-", $hotel->name) . "_" . $room->code] = array(
                            "code" => $room->code,
                            "name" => "",
                            "hotel" => array(
                                "name" => $hotel->name,
                                "stars" => $hotel->stars,
                            ),
                            "prices" => array(
                                $sourceName => $room->total
                            )
                        );
                    }
                }
            }
        }
        return $rooms;
    }
}