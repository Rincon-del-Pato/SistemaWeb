<?php

namespace App\Enums;

enum CommandStatus: string
{
    case Pendiente = 'Pendiente';
    case En_Progreso = 'En_Progreso';
    case Completado = 'Completado';
    case Cancelado = 'Cancelado';
}
