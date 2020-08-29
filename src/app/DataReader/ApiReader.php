<?php

namespace App\DataReader;

Class ApiReader implements Reader{
    private $endpoint;

    public function __construct($endpoint){
        $this->endpoint = $endpoint;
    }

    public function read(){
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
        );
        $ch = curl_init($this->endpoint);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
}