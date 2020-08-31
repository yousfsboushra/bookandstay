<?php
declare(strict_types=1);

use App\Client;
use App\DataSorter\PriceSorter;

require __DIR__ . '/vendor/autoload.php';

$inputsJson = file_get_contents('input.json');
$priceSorter = new PriceSorter();
$client = new Client(json_decode($inputsJson), $priceSorter);
$client->createReadersAndParsers();
$rooms = $client->readAndFilterRooms();
print json_encode($rooms);