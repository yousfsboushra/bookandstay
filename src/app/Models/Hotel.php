<?php
namespace App\Models;

class Hotel{
    private $name;
    private $stars;

    private static $instances = array();

    private function __construct(string $name, int $stars){
        $this->name = $name;
        $this->stars = $stars;
    }

    public static function createInstance(string $name, int $stars){
        $hotelIndex = str_replace(" ", "-", $name);
        if(!isset(self::$instances[$hotelIndex])){
            self::$instances[$hotelIndex] = new Static($name, $stars);
        }
        return self::$instances[$hotelIndex];
    }

    public function getName(){
        return $this->name;
    }
}