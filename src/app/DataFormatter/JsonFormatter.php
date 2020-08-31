<?php
declare(strict_types=1);

namespace App\DataFormatter;

Class JsonFormatter implements Formatter{

    public function __construct(){
    }

    public function format($items){
        return json_encode($items);
    }
}