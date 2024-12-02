<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithMapping};

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Order::whereBetween('order_date', [$this->startDate, $this->endDate])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Total',
            'Estado'
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->order_date,
            $order->total,
            $order->status
        ];
    }
}
