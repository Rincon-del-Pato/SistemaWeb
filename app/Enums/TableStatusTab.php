<?php

namespace App\Enums;

enum TableStatusTab: string
{
    case Disponible = 'Disponible';
    case Ocupado = 'Ocupado';
    case Reservado = 'Reservado';
}
