<?php
declare(strict_types=1);

namespace App\DataReader;

Class FileReader implements Reader{
    private $filepath;

    public function __construct($filepath){
        $this->filepath = (isset($filepath))? $filepath : "";
    }

    public function read(){
        $content = "";
        if (file_exists($this->filepath)) {
            $content = "";
            $fh = fopen($this->filepath,'r');
            while ($line = fgets($fh)) {
                $content .= $line;
            }
            fclose($fh);
        }
        return $content;
    }
}