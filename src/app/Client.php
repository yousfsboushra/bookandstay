<?php
declare(strict_types=1);

namespace App;

use App\DataSorter\Sorter;
use App\DataFormatter\Formatter;
use App\Models\Room;

class Client{
    private $inputs = array();
    private $readers = array();
    private $parsers = array();
    private $sorter;
    private $formatter;

    public function __construct($jsonInput, Sorter $sorter, Formatter $formatter){
        $this->createReadersAndParsers($jsonInput);
        $this->sorter = $sorter;
        $this->formatter = $formatter;
    }

    public function createReadersAndParsers($jsonInput){
        $inputs = json_decode($jsonInput);
        if(!empty($inputs)){
            foreach($inputs as $input){
                if(isset($input->source) && isset($input->type)){
                    $this->inputs[] = $input;
                    switch($input->source){
                        case 'api':
                            $this->readers[] = new \App\DataReader\ApiReader($input->endpoint, $input->headers);
                        break;
                        case 'file':
                            $this->readers[] = new \App\DataReader\FileReader($input->path);
                        break;
                    }                
                    switch($input->type){
                        case 'json1':
                            $this->parsers[] = \App\Parser\JsonParser1::getInstance();
                        break;
                        case 'json2':
                            $this->parsers[] = \App\Parser\JsonParser2::getInstance();
                        break;
                    }
                }
            }
        }
    }

    public function readFilterAndSortRooms(){
        if(!empty($this->inputs)){
            foreach($this->inputs as $index => $input){
                $data = $this->readers[$index]->read();
                $this->parsers[$index]->parseRooms($data, $input->name);
            }
        }
        $rooms = Room::getRooms();
        $result = array();
        if(!empty($rooms)){
            $result = $this->sorter->sort($rooms);
        }else{
            $result = array("response" => "No rooms found");
        }
        return $this->formatter->format($result);
    }
}