<?php
declare(strict_types=1);

namespace App\DataSorter;

Class PriceSorter implements Sorter{

    public function __construct(){
    }

    public function sort($rooms){
        usort($rooms, function($room1, $room2){
            return ($room1->getMinPrice() < $room2->getMinPrice()) ? -1 : 1;
        });
        return $rooms;
    }
}