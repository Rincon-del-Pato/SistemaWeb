<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Comprobante</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        hr {
            border: 1px dashed #000;
            margin: 5px 0;
        }

        /* Estilos del encabezado */
        h2 {
            font-size: 20px;
            margin: 0;
            padding: 0;
        }

        .invoice-number {
            font-size: 16px;
            margin: 5px 0;
        }

        .header-info {
            margin: 10px 0;
            font-size: 14px;
        }

        /* Estilos de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 5px;
        }

        table th {
            text-align: left;
            border-bottom: 1px solid #000;
        }

        table td {
            text-align: right;
        }

        table td.text-left {
            text-align: left;
        }

        /* Estilos del pie */
        .footer {
            margin-top: 15px;
            font-size: 12px;
        }

        .footer p {
            margin: 0;
        }

        /* Estilos para los totales */
        .totals {
            margin-top: 10px;
            font-size: 14px;
        }

        .totals p {
            margin: 0;
            font-weight: bold;
        }

        /* Estilo de separación */
        .separator {
            border-top: 1px solid #000;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="text-center">
            <h2>{{ config('app.name') }}</h2>
            <p class="invoice-number">
                {{ $order->invoice->series }}-{{ str_pad($order->invoice->number, 8, '0', STR_PAD_LEFT) }}</p>
            <div class="header-info">
                <p>Cliente: {{ $order->invoice->customer_name }}</p>
                <p>{{ $order->invoice->customer_document_type }}: {{ $order->invoice->customer_document_number }}</p>
                <p>Fecha: {{ \Carbon\Carbon::parse($order->invoice->issue_date)->format('d/m/Y H:i') }}</p>
            </div>
            <hr>
        </div>

        <!-- Detalle de productos -->
        <table>
            <tr>
                <th class="text-left">Descripción</th>
                <th class="text-right">Cant.</th>
                <th class="text-right">P.U.</th>
                <th class="text-right">Total</th>
            </tr>
            @foreach ($order->invoice->items as $item)
                <tr>
                    <td class="text-left">{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach
        </table>

        <div class="separator"></div>

        <!-- Totales -->
        <div class="totals text-right">
            <p>Subtotal: S/ {{ number_format($order->invoice->total - $order->invoice->tax, 2) }}</p>
            <p>IGV: S/ {{ number_format($order->invoice->tax, 2) }}</p>
            <p>Total: S/ {{ number_format($order->invoice->total, 2) }}</p>
        </div>

        <div class="separator"></div>

        <!-- Pie -->
        <div class="footer text-center">
            <p>¡Gracias por su preferencia!</p>
            <p>Representación impresa de la {{ $order->invoice->invoice_type }} Electrónica</p>
            <p>Consulte este documento en <a href="https://www.sunat.gob.pe" target="_blank">www.sunat.gob.pe</a></p>
        </div>
    </div>
</body>

</html>
