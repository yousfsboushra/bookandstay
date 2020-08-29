<?php
namespace App\Models;

class Hotel{
    private $name;
    private $stars;

    public function __construct($name, $stars){
        $this->name = $name;
        $this->stars = $stars;
    }

    public function getName(){
        return $this->name;
    }

    public function getStars(){
        return $this->stars;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setStars($stars){
        $this->stars = $stars;
    }
}