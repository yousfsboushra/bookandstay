<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\DataReader\ApiReader;

class ApiReaderTest extends TestCase{
    public function testGoodAPIReader(){
        $reader = new ApiReader("http://localhost:9000/apiReaderExample.json", array());
        $json = file_get_contents("apiReaderExample.json");
        $apiJson = $reader->read();
        $this->assertJsonStringEqualsJsonString($apiJson, $json);
    }
}
