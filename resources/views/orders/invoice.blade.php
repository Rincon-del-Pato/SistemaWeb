<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprobante</title>
    <style>
        /* Estilos para el ticket */
        body { font-family: 'Arial', sans-serif; font-size: 12px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mb-2 { margin-bottom: 10px; }
        hr { border: 1px dashed #000; }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>{{ config('app.name') }}</h2>
        <p>{{ $order->invoice->series }}-{{ str_pad($order->invoice->number, 8, '0', STR_PAD_LEFT) }}</p>
        <hr>
    </div>

    <div class="mb-2">
        <p>Cliente: {{ $order->invoice->customer_name }}</p>
        <p>{{ $order->invoice->customer_document_type }}: {{ $order->invoice->customer_document_number }}</p>
        <p>Fecha: {{ \Carbon\Carbon::parse($order->invoice->issue_date)->format('d/m/Y H:i') }}</p>
    </div>

    <hr>
    <table width="100%">
        <tr>
            <th class="text-left">Descripción</th>
            <th class="text-right">Cant.</th>
            <th class="text-right">P.U.</th>
            <th class="text-right">Total</th>
        </tr>
        @foreach($order->invoice->items as $item)
        <tr>
            <td>{{ $item->description }}</td>
            <td class="text-right">{{ $item->quantity }}</td>
            <td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
            <td class="text-right">{{ number_format($item->total_price, 2) }}</td>
        </tr>
        @endforeach
    </table>
    <hr>

    <div class="text-right">
        <p>Subtotal: S/ {{ number_format($order->invoice->total - $order->invoice->tax, 2) }}</p>
        <p>IGV: S/ {{ number_format($order->invoice->tax, 2) }}</p>
        <p>Total: S/ {{ number_format($order->invoice->total, 2) }}</p>
    </div>

    <div class="text-center">
        <p>¡Gracias por su preferencia!</p>
        <p>Representación impresa de la {{ $order->invoice->invoice_type }} Electrónica</p>
        <p>Consulte este documento en www.sunat.gob.pe</p>
    </div>
</body>
</html>
