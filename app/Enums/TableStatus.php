<?php

namespace App\Enums;

enum TableStatus: string
{
    case Disponible = 'Disponible';
    case Ocupado = 'Ocupado';
    case Reservado = 'Reservado';
}

