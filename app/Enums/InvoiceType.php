<?php

namespace App\Enums;

enum InvoiceType: string
{
    case Boleta = 'Boleta';
    case Factura = 'Factura';

    public static function fromValue(?string $value): ?self
    {
        if ($value === null) {
            return null;
        }

        $value = ucfirst(strtolower($value));
        return self::from($value);
    }
}
