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
        $this->sorter = new PriceSorter();
        $this->formatter = new JsonFormatter();

    }
    
    public function testGoodClient(){
        $jsonInput = '[
            {
                "source": "file",
                "name": "Airbnb.com",
                "path": "datasources/1.json",
                "type": "json1"
            }
        ]';
        $client = new Client($jsonInput, $this->sorter, $this->formatter);
        $result = $client->readFilterAndSortRooms();
        
        $json = '[{"name":"","code":"SNGRM","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":115}},{"name":"","code":"HF-BOD","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":143}},{"name":"","code":"HF-BD","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":146}},{"name":"","code":"DBL-TWN","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":152}},{"name":"","code":"QUN-ROM","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":154.5}},{"name":"","code":"QN-RM","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":158}},{"name":"","code":"DBL-RM","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":165}},{"name":"","code":"POAROM","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":169}},{"name":"","code":"FU-BOD","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":176}}]';
        $this->assertJsonStringEqualsJsonString($result, $json);
    }
}
