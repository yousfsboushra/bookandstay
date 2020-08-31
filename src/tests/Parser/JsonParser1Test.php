<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Parser\JsonParser1;
use App\DataReader\FileReader;
use App\Models\Room;

class JsonParser1Test extends TestCase{
    private $data;

    public function setUp(): void{
        Room::resetRooms();
        $reader = new FileReader("tests/input/datasources/1.json");
        $this->data = $reader->read();
    }

    public function testJsonParser1Good(){
        $parser = JsonParser1::getInstance();
        $data = $parser->parseRooms($this->data, "Booking.com");
        $rooms = Room::getRooms();

        $this->assertIsArray($rooms);
        $this->assertIsObject($rooms['Hotel-A_DBL-TWN']);
        $this->assertObjectHasAttribute('name', $rooms['Hotel-A_DBL-TWN']);
        $this->assertObjectHasAttribute('code', $rooms['Hotel-A_DBL-TWN']);
        $this->assertObjectHasAttribute('hotel', $rooms['Hotel-A_DBL-TWN']);
        $this->assertObjectHasAttribute('minPrice', $rooms['Hotel-A_DBL-TWN']);
        $this->assertObjectHasAttribute('prices', $rooms['Hotel-A_DBL-TWN']);
    }
}
