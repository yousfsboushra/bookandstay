<?php

namespace App\Parser;

interface Parser{
    public function parseRooms($content, $sourceName);
}