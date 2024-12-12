<?php

namespace App\Enums;

enum CommandStatus: string
{
    case Pendiente = 'Pendiente';
    case En_Progreso = 'En_Progreso';
    case Enviando = 'Enviando';
    case Completado = 'Completado';
    case Cancelado = 'Cancelado';

    public static function getNiceText($status): string 
    {
        return str_replace('_', ' ', $status);
    }
}
