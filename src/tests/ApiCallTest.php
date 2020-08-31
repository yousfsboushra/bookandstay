<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\DataReader\ApiReader;

class ApiCallTest extends TestCase{
    public function testGoodAPIReader(){
        $body = file_get_contents('http://localhost:9000');

        $json = '[{"name":"Single Bed","code":"SNG-RM","hotel":{"name":"Hotel C","stars":5},"prices":{"Airbnb.com2":108,"Booking.com":108}},{"name":"","code":"SNGRM","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":115}},{"name":"HALF BOARD","code":"HF-BD","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":146,"Airbnb.com2":142,"Booking.com":142}},{"name":"HALF BOARD","code":"HF-BOD","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":143,"Airbnb.com2":147,"Booking.com":147}},{"name":"Queen Room","code":"QUN-ROM","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":154.5,"Airbnb.com2":146.5,"Booking.com":146.5}},{"name":"Double or Twin SUPERIOR","code":"DBL-TWN","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":152,"Airbnb.com2":153,"Booking.com":153}},{"name":"Queen Room","code":"QN-RM","hotel":{"name":"Hotel A","stars":4},"prices":{"Airbnb.com":158,"Airbnb.com2":156,"Booking.com":156}},{"name":"Double Room","code":"DBL-RM","hotel":{"name":"Hotel B","stars":5},"prices":{"Airbnb.com":165,"Airbnb.com2":167,"Booking.com":167}},{"name":"","code":"POAROM","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":169}},{"name":"","code":"FU-BOD","hotel":{"name":"Hotel D","stars":5},"prices":{"Airbnb.com":176}},{"name":"FULL BOARD","code":"FUBOD","hotel":{"name":"Hotel C","stars":5},"prices":{"Airbnb.com2":180,"Booking.com":180}},{"name":"Luxury Room","code":"LUX-ROM","hotel":{"name":"Hotel C","stars":5},"prices":{"Airbnb.com2":199,"Booking.com":199}}]';

        $this->assertJsonStringEqualsJsonString($body, $json);
    }
}
