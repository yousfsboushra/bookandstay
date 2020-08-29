<?php

namespace App\Parser;

Class XmlParser1 implements Parser{
    private static $instance = null;

    private function __construct(){}

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function parseRooms($xml){
        $rooms = array();
        $json = json_encode(simplexml_load_string($xml));
        return $rooms;
    }
}