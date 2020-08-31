<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Parser\JsonParser2;
use App\DataReader\FileReader;
use App\Models\Room;

class JsonParser2Test extends TestCase{
    private $data;

    public function setUp(): void{
        Room::resetRooms();
        $reader = new FileReader("tests/input/datasources/2.json");
        $this->data = $reader->read();
    }

    public function testJsonParser2Good(){
        $parser = JsonParser2::getInstance();
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
