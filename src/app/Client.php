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
        $this->inputs = json_decode($jsonInput);
        $this->sorter = $sorter;
        $this->formatter = $formatter;
        $this->createReadersAndParsers(); // To be moved outside the class
    }

    public function createReadersAndParsers(){
        foreach($this->inputs as $input){
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

    public function readFilterAndSortRooms(){
        foreach($this->readers as $index => $reader){
            $data = $reader->read();
            $data = $this->parsers[$index]->parseRooms($data, $this->inputs[$index]->name);
        }
        $rooms = Room::getRooms();
        $sortedRooms = $this->sorter->sort($rooms);
        return $this->formatter->format($sortedRooms);
    }
}