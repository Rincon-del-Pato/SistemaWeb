<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function print(Invoice $invoice)
    {
        $invoice->load(['order.user', 'items']);

        $pdf = PDF::loadView('invoices.print', compact('invoice'));

        // Configurar el tamaño del papel para tickets
        $pdf->setPaper([0, 0, 226.77, 841.89], 'portrait'); // 80mm (ancho) x 297mm (alto)

        return $pdf->stream('comprobante-' . $invoice->series . '-' . $invoice->number . '.pdf');
    }
}
