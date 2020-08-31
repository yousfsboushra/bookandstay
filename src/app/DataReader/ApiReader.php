<?php
declare(strict_types=1);

namespace App\DataReader;

Class ApiReader implements Reader{
    private $endpoint;
    private $headers;

    public function __construct($endpoint, $headers){
        $this->endpoint = $endpoint;
        $this->headers = $headers;
    }

    public function read(){
        $content = "";
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $this->headers
        );
        $ch = curl_init($this->endpoint);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if($info['http_code'] == 200){
            $content = $result;
        }
        curl_close($ch);
        return $content;
    }
}