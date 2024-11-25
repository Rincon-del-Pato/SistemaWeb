<?php

namespace App\Enums;

enum OrderType: string
{
    case Local = 'Local';
    case Delivery = 'Delivery';
    case ParaLlevar = 'ParaLlevar';
}
