<?php
namespace App\Models;

class Room{
    private $name;
    private $code;
    private $hotel;
    private $prices;
    private $minPrice;
    private static $instances = array();

    private function __construct(string $name, string $code, Hotel $hotel, float $price, string $sourceName){
        $this->name = $name;
        $this->code = $code;
        $this->hotel = $hotel;
        $this->minPrice = $price;
        $this->prices = array(
            $sourceName => $price
        );
    }

    public static function createInstance(string $name, string $code, Hotel $hotel, float $price, string $sourceName){
        $roomIndex = str_replace(" ", "-", $hotel->getName()) . "_" . $code;
        if(isset(self::$instances[$roomIndex])){
            self::$instances[$roomIndex]->setName($name);
            self::$instances[$roomIndex]->addPrice($price, $sourceName);

        }else{
            self::$instances[$roomIndex] = new Static($name, $code, $hotel, $price, $sourceName);
        }
    }

    public function setName(string $name){
        if(!empty($name)){
            $this->name = $name;
        }
    }

    public function addPrice(float $price, string $sourceName){
        if(!empty($sourceName) && is_numeric($price)){
            $this->prices[$sourceName] = $price;
            if($price < $this->minPrice){
                $this->minPrice = $price;
            }
        }
    }

    public static function getRooms(){
        return self::$instances;
    }

}