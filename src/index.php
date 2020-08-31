<?php
declare(strict_types=1);

use App\Client;
use App\DataSorter\PriceSorter;

require __DIR__ . '/vendor/autoload.php';

$inputsJson = '[
    {
        "source": "file",
        "name": "Airbnb.com",
        "path": "datasources/1.json",
        "type": "json1"
    },
    {
        "source": "file",
        "name": "Airbnb.com2",
        "path": "datasources/2.json",
        "type": "json2"
    },
    {
        "source": "api",
        "name": "Booking.com",
        "endpoint": "http://localhost/apiReaderExample.json",
        "headers": {},
        "type": "json2"
    }
]';
$priceSorter = new PriceSorter();
$client = new Client(json_decode($inputsJson), $priceSorter);
$client->createReadersAndParsers();
$rooms = $client->readAndFilterRooms();
// print_r($rooms);
print json_encode($rooms);