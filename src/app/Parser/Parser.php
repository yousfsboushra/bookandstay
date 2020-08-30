<?php
declare(strict_types=1);

namespace App\Parser;

interface Parser{
    public function parseRooms($content, $sourceName);
}