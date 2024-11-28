
<?php

namespace App\Exports;

use App\Models\InventoryItem;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InventoryExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return InventoryItem::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Cantidad',
            'Nivel de Reorden',
            'Unidad'
        ];
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->name,
            $item->quantity,
            $item->reorder_level,
            $item->unit->name ?? 'N/A'
        ];
    }
}