<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\DataSorter\PriceSorter;
use App\Models\Hotel;
use App\Models\Room;

class PriceSorterTest extends TestCase{
    public function setUp(): void{
        $hotelObject = Hotel::createInstance("Holiday Inn", 5);
        Room::resetRooms();
        Room::createInstance("", "FAM-RM", $hotelObject, 115.05, "Booking.com");
        Room::createInstance("", "FAM-RM", $hotelObject, 110.00, "Airbnb.com");
        Room::createInstance("", "DBL-RM", $hotelObject, 75.50, "Booking.com");
        Room::createInstance("", "TRI-RM", $hotelObject, 100.00, "Booking.com");
    }

    public function testGoodSort(){
        $rooms = Room::getRooms();
        $priceSorter = new PriceSorter();
        $sortedRooms = $priceSorter->sort($rooms);

        $this->assertIsArray($sortedRooms);
        $this->assertIsObject($sortedRooms[0]);
        $this->assertEquals($sortedRooms[0]->getMinPrice(), 75.50);
        $this->assertEquals($sortedRooms[1]->getMinPrice(), 100.00);
        $this->assertEquals($sortedRooms[2]->getMinPrice(), 110.00);
    }
}
