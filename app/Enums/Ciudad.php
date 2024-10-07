<?php

namespace App\Enums;

enum Ciudad: string
{
    case Lima = 'Lima';
    case Cusco = 'Cusco';
    case Arequipa = 'Arequipa';
    case Trujillo = 'Trujillo';
    case Piura = 'Piura';

    public static function ciudadesPorRegion(Region $region): array
    {
        return match($region) {
            Region::Lima => [
                self::Lima,
                // otras ciudades de Lima
            ],
            Region::Arequipa => [
                self::Arequipa,
                // otras ciudades de Arequipa
            ],
            // Continúa con las demás regiones...
            default => [],
        };
    }
}
