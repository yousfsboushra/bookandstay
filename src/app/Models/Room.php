<?php
namespace App\Models;

class Room{
    private $name;
    private $code;
    private $hotel;
    private $prices;


    public function __construct(string $name, string $code, Hotel $hotel, $price){
        $this->name = $name;
        $this->code = $code;
        $this->hotel = $hotel;
        $this->prices = array($price);
    }

    public function getName(){
        return $this->name;
    }

    public function getCode(){
        return $this->code;
    }

    public function getHotel(){
        return $this->hotel;
    }

    public function getPrices(){
        return $this->prices;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setCode($code){
        $this->code = $code;
    }

    public function setHotel($hotel){
        $this->hotel = $hotel;
    }

    public function addPrice($price){
        $this->prices[] = $price;
    }

}