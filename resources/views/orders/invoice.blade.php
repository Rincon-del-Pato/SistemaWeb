<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $order->invoice->invoice_type }} Electrónica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
            width: 226.77px;
            height: auto;
            /* Se elimina el border: 1px solid #000; */
        }

        .container {
            width: 100%;
            padding: 5px;
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
            border: none;
            border-top: 1px solid #000;
            /* Cambiado de dashed a solid */
            margin: 5px 0;
        }

        .separator {
            border-top: 1px solid #000;
            margin: 5px 0;
        }

        /* Estilos del encabezado */
        .logo {
            width: 40px;
            height: auto;
            margin: 2px auto;
        }

        h2 {
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header-info {
            font-size: 9px;
            line-height: 1.2;
        }

        /* Estilos de tabla y totales */
        table {
            width: 100%;
            font-size: 9px;
            border-collapse: collapse;
            border: 1px solid #000;
            /* Añadir borde a la tabla */
        }

        table th,
        table td {
            padding: 3px;
            text-align: left;
            border: 1px solid #000;
            /* Añadir borde a las celdas */
        }

        .totals {
            margin-top: 10px;
            font-size: 12px;
            /* Aumentar el tamaño de fuente */
            font-weight: bold;
            text-align: right;
            /* Alinear a la derecha */
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 8px;
            font-style: italic;
            /* Añadir estilo cursiva */
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="text-center">
            <img src="{{ public_path('imagen/pato.png') }}" class="logo">
            <h2>Rincón del Pato</h2>
            <p class="header-info">
                Jr. Alianza 782, Guadalupe 13841<br>
                RUC: 12345678901<br>
                Guadalupe - Perú
            </p>
        </div>

        <hr>

        <!-- Información del Cliente -->
        <div>
            <p>Cliente: <strong>{{ $order->invoice->customer_name }}</strong></p>
            @if ($order->invoice->customer_name !== 'Cliente General')
                <p>{{ $order->invoice->customer_document_type }}:
                    <strong>{{ $order->invoice->customer_document_number }}</strong></p>
            @endif
        </div>

        <hr>

        <!-- Información del Comprobante -->
        <div class="text-center">
            <p><strong>{{ $order->invoice->invoice_type }} Electrónica </strong></p>
            <p>{{ $order->invoice->series }}-{{ str_pad($order->invoice->number, 8, '0', STR_PAD_LEFT) }}</p>
        </div>

        <hr>

        <!-- Fecha y Hora -->
        <div>
            <p>Fecha: <strong>{{ \Carbon\Carbon::parse($order->invoice->issue_date)->format('d/m/Y H:i') }}</strong></p>
        </div>

        <hr>

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
        {{-- <table>
            @foreach ($order->invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td class="text-right">{{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach
        </table> --}}

        <hr>

        <!-- Totales -->
        <div>
            <p class="totals">**** TOTAL S/ {{ number_format($order->invoice->total, 2) }}</p>
        </div>

        <hr>

        <!-- Pie de página -->
        <div class="footer">
            <p>¡Gracias por su preferencia!</p>
            <p>Representación impresa de la {{ $order->invoice->invoice_type }} Electrónica</p>
            <p>Consulte este documento en www.sunat.gob.pe</p>
        </div>
    </div>
</body>

</html>
