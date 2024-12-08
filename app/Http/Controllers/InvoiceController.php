<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::with(['order.user', 'items'])
            ->when($request->search, function($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('series', 'like', "%{$search}%")
                      ->orWhere('number', 'like', "%{$search}%")
                      ->orWhere('customer_name', 'like', "%{$search}%")
                      ->orWhere('customer_document_number', 'like', "%{$search}%");
                });
            })
            ->when($request->date_from, function($query, $date) {
                return $query->whereDate('issue_date', '>=', $date);
            })
            ->when($request->date_to, function($query, $date) {
                return $query->whereDate('issue_date', '<=', $date);
            })
            ->latest()
            ->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $order = $invoice->order;
        $pdf = PDF::loadView('orders.invoice', compact('order'));
        $pdf->setPaper([0, 0, 226.77, 841.89], 'portrait');

        return $pdf->stream('comprobante-' . $invoice->series . '-' . $invoice->number . '.pdf');
    }

    public function print(Invoice $invoice)
    {
        $invoice->load(['order.user', 'items']);

        $pdf = PDF::loadView('invoices.print', compact('invoice'));

        // Configurar el tamaño del papel para tickets
        $pdf->setPaper([0, 0, 226.77, 841.89], 'portrait'); // 80mm x 297mm

        // Configurar metadatos del PDF
        $options = $pdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('title', 'Comprobante ' . $invoice->series . '-' . $invoice->number);
        $options->set('author', config('app.name'));
        $options->set('subject', 'Comprobante de Pago');
        $options->set('creator', config('app.name'));

        return $pdf->stream("comprobante-{$invoice->series}-{$invoice->number}.pdf");
    }

    public function details(Invoice $invoice)
    {
        return view('invoices.details', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $pdf = PDF::loadView('invoices.print', compact('invoice'));
        return $pdf->download("comprobante-{$invoice->series}-{$invoice->number}.pdf");
    }
}
