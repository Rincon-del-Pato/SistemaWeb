<?php

namespace App\Exports;

use App\Models\InventoryItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class InventoryExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return InventoryItem::all();
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
