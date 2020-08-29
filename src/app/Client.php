<?php

namespace App;

class Client{
    private $inputs = array();
    private $readers = array();
    private $parsers = array();

    public function __construct($inputsJson){
        $this->inputs = json_decode($inputsJson);
    }

    public function createReadersAndParsers(){
        foreach($this->inputs as $input){
            switch($input->source){
                case 'api':
                    $this->readers[] = new \App\DataReader\ApiReader($input->endpoint);
                break;
                case 'file':
                    $this->readers[] = new \App\DataReader\FileReader($input->path);
                break;
            }
            switch($input->type){
                case 'xml':
                    $this->parsers[] = \App\Parser\XmlParser1::getInstance();
                break;
                case 'json2':
                    $this->parsers[] = \App\Parser\JsonParser2::getInstance();
                break;
                default:
                    $this->parsers[] = \App\Parser\JsonParser1::getInstance();
                break;
            }
        }
    }

    public function readAndFilterRooms(){
        foreach($this->readers as $index => $reader){
            $data = $reader->read();
            $data = $this->parsers[$index]->parseRooms($data, $this->inputs[$index]->name);
        }
        print_r(\App\Models\Room::getRooms());
    }
}