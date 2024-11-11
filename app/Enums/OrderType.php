<?php

namespace App\Enums;

enum OrderType: string
{
    case Mesa = 'Mesa';
    case ParaLlevar = 'ParaLlevar';
    case Delivery = 'Delivery';
}
