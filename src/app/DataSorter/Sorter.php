<?php
declare(strict_types=1);

namespace App\DataSorter;

interface Sorter{
    public function sort($items);
}