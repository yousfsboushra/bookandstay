<?php
declare(strict_types=1);

namespace App\DataReader;

Class FileReader implements Reader{
    private $filepath;

    public function __construct($filepath){
        $this->filepath = $filepath;
    }

    public function read(){
        $content = "";
        if (file_exists($this->filepath)) {
            $content = file_get_contents($this->filepath);
        }
        return $content;
    }
}