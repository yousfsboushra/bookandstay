<?php
declare(strict_types=1);

namespace App\DataFormatter;

interface Formatter{
    public function format($items);
}