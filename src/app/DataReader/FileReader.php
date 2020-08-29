<?php

namespace App\DataReader;

Class FileReader implements Reader{
    private $filepath;

    public function __construct($filepath){
        $this->filepath = $filepath;
    }

    public function read(){
        $content = array();
        if (file_exists($this->filepath)) {
            $content = file_get_contents($this->filepath);
        }
        return $content;
    }
}