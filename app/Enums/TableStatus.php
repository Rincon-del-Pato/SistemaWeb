<?php

namespace App\Enums;

enum TableStatus: string
{
    case Available = 'Available';
    case Occupied = 'Occupied';
    case Reserved = 'Reserved';
}
