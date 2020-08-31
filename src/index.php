<?php
declare(strict_types=1);

use App\Client;
use App\DataSorter\PriceSorter;
use App\DataFormatter\JsonFormatter;

require __DIR__ . '/vendor/autoload.php';

$jsonInput = file_get_contents('input/input.json');

$sorter = new PriceSorter();
$formatter = new JsonFormatter();

$client = new Client($jsonInput, $sorter, $formatter);

header("Content-Type: application/json");
print $client->readFilterAndSortRooms();