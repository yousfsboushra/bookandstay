<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Client;
use App\DataSorter\PriceSorter;
use App\DataFormatter\JsonFormatter;
use App\Models\Room;

class ClientTest extends TestCase{
    private $sorter;
    private $formatter;
    public function setUp(): void{
        Room::resetRooms();
        $this->sorter = new PriceSorter();
        $this->formatter = new JsonFormatter();

    }
    
    public function testGoodFileInput(){
        $jsonInput = '[
            {
                "source": "file",
                "name": "Airbnb.com",
                "path": "tests/input/datasources/1.json",
                "type": "json1"
            }
        ]';
        $client = new Client($jsonInput, $this->sorter, $this->formatter);
        $actual = $client->readFilterAndSortRooms();
        
        $expected = '[{"name":"","code":"SNGRM","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":115}},{"name":"","code":"HF-BOD","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":143}},{"name":"","code":"HF-BD","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":146}},{"name":"","code":"DBL-TWN","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":152}},{"name":"","code":"QUN-ROM","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":154.5}},{"name":"","code":"QN-RM","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":158}},{"name":"","code":"DBL-RM","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":165}},{"name":"","code":"POAROM","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":169}},{"name":"","code":"FU-BOD","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":176}}]';
        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }

    public function testGood2FileInputs(){
        $jsonInput = '[
            {
                "source": "file",
                "name": "Booking.com",
                "path": "tests/input/datasources/1.json",
                "type": "json1"
            },
            {
                "source": "file",
                "name": "Airbnb.com",
                "path": "tests/input/datasources/2.json",
                "type": "json2"
            }
        ]';
        $client = new Client($jsonInput, $this->sorter, $this->formatter);
        $actual = $client->readFilterAndSortRooms();
        
        $expected = '[{"name":"Single Bed","code":"SNG-RM","hotel":{"name":"Hotel C","stars":5},"prices":{"Airbnb.com":108}},{"name":"","code":"SNGRM","hotel":{"name":"Hotel D","stars":5},"prices":{"Booking.com":115}},{"name":"HALF BOARD","code":"HF-BD","hotel":{"name":"Hotel A","stars":4},"prices":{"Booking.com":146,"Airbnb.com":142}},{"name":"HALF BOARD","code":"HF-BOD","hotel":{"name":"Hotel B","stars":5},"prices":{"Booking.com":143,"Airbnb.com":147}},{"name":"Queen Room","code":"QUN-ROM","hotel":{"name":"Hotel B","stars":5},"prices":{"Booking.com":154.5,"Airbnb.com":146.5}},{"name":"Double or Twin SUPERIOR","code":"DBL-TWN","hotel":{"name":"Hotel A","stars":4},"prices":{"Booking.com":152,"Airbnb.com":153}},{"name":"Queen Room","code":"QN-RM","hotel":{"name":"Hotel A","stars":4},"prices":{"Booking.com":158,"Airbnb.com":156}},{"name":"Double Room","code":"DBL-RM","hotel":{"name":"Hotel B","stars":5},"prices":{"Booking.com":165,"Airbnb.com":167}},{"name":"","code":"POAROM","hotel":{"name":"Hotel D","stars":5},"prices":{"Booking.com":169}},{"name":"","code":"FU-BOD","hotel":{"name":"Hotel D","stars":5},"prices":{"Booking.com":176}},{"name":"FULL BOARD","code":"FUBOD","hotel":{"name":"Hotel C","stars":5},"prices":{"Airbnb.com":180}},{"name":"Luxury Room","code":"LUX-ROM","hotel":{"name":"Hotel C","stars":5},"prices":{"Airbnb.com":199}}]';
        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }

    public function testGood1ApiInput(){
        $jsonInput = '[
            {
                "source": "api",
                "name": "Booking.com",
                "endpoint": "https://f704cb9e-bf27-440c-a927-4c8e57e3bad1.mock.pstmn.io/s1/availability",
                "headers": {},
                "type": "json1"
            }
        ]';
        $client = new Client($jsonInput, $this->sorter, $this->formatter);
        $actual = $client->readFilterAndSortRooms();
        
        $expected = '[{"name":"","code":"SNGRM","hotel":{"name":"Hotel D","stars":5},"prices":{"Booking.com":115}},{"name":"","code":"HF-BOD","hotel":{"name":"Hotel B","stars":5},"prices":{"Booking.com":143}},{"name":"","code":"HF-BD","hotel":{"name":"Hotel A","stars":4},"prices":{"Booking.com":146}},{"name":"","code":"DBL-TWN","hotel":{"name":"Hotel A","stars":4},"prices":{"Booking.com":152}},{"name":"","code":"QUN-ROM","hotel":{"name":"Hotel B","stars":5},"prices":{"Booking.com":154.5}},{"name":"","code":"QN-RM","hotel":{"name":"Hotel A","stars":4},"prices":{"Booking.com":158}},{"name":"","code":"DBL-RM","hotel":{"name":"Hotel B","stars":5},"prices":{"Booking.com":165}},{"name":"","code":"POAROM","hotel":{"name":"Hotel D","stars":5},"prices":{"Booking.com":169}},{"name":"","code":"FU-BOD","hotel":{"name":"Hotel D","stars":5},"prices":{"Booking.com":176}}]';
        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }

    public function testEmptyInput(){
        $jsonInput = '';
        $client = new Client($jsonInput, $this->sorter, $this->formatter);
        $actual = $client->readFilterAndSortRooms();
        
        $expected = '{"response": "No rooms found"}';
        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }
}
