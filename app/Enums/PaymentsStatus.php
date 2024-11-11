<?php

namespace App\Enums;

enum PaymentsStatus: string
{
    case Pendiente = 'Pendiente';
    case Pagado = 'Pagado';
    case Anulado = 'Anulado';
}
