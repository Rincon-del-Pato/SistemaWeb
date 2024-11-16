<?php

namespace App\Enums;

enum ChangeType: string
{
    case Creado = 'Creado';
    case Adición = 'Adición';
    case Disminuir = 'Disminuir';
}