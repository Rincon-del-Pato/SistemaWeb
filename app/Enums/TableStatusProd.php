<?php

namespace App\Enums;

enum TableStatusProd: string
{
    case Disponible = 'Disponible';
    case No_Disponible = 'No disponible';
    case Agotado = 'Agotado';
    // case Oculto = 'Oculto';
}
