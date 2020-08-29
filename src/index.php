<?php
require __DIR__ . '/vendor/autoload.php';

$inputsJson = '[
    {
        "source": "api",
        "name": "Booking.com",
        "endpoint": "http://localhost/apiReaderExample.json",
        "type": "json1"
    },{
        "source": "file",
        "name": "Airbnb.com",
        "path": "datasources/1.json",
        "type": "json2"
    }
]';

$client = new App\Client($inputsJson);
$client->createReadersAndParsers();
$client->readAndFilterRooms();