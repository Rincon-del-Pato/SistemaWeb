<?php

namespace App\Enums;

enum OrderType: string
{
    case Mesas = 'Mesas';
    case ParaLlevar = 'ParaLlevar';
    case Delivery = 'Delivery';
}
