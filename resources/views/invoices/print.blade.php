
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .document-type {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .document-number {
            font-size: 14px;
            margin-bottom: 15px;
        }
        .customer-info {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 8px 4px;
            font-size: 11px;
        }
        th {
            text-align: left;
            background-color: #f8f9fa;
        }
        .totals {
            text-align: right;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">{{ config('app.name', 'Restaurante') }}</div>
        <div class="document-type">
            {{ strtoupper($invoice->invoice_type) }} ELECTRÓNICA
        </div>
        <div class="document-number">
            {{ $invoice->series }}-{{ str_pad($invoice->number, 8, '0', STR_PAD_LEFT) }}
        </div>
    </div>

    <div class="customer-info">
        <p><strong>Fecha:</strong> {{ $invoice->issue_date->format('d/m/Y H:i') }}</p>
        <p><strong>Cliente:</strong> {{ $invoice->customer_name }}</p>
        <p><strong>{{ $invoice->customer_document_type }}:</strong> {{ $invoice->customer_document_number }}</p>
        @if($invoice->customer_address)
            <p><strong>Dirección:</strong> {{ $invoice->customer_address }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Descripción</th>
                <th>P.U.</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->description }}</td>
                    <td>S/. {{ number_format($item->unit_price, 2) }}</td>
                    <td>S/. {{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p>Sub Total: S/. {{ number_format($invoice->total / 1.18, 2) }}</p>
        <p>IGV (18%): S/. {{ number_format($invoice->tax, 2) }}</p>
        <p><strong>Total: S/. {{ number_format($invoice->total, 2) }}</strong></p>
    </div>

    <div class="footer">
        <p>Representación impresa de la {{ $invoice->invoice_type }} Electrónica</p>
        <p>Consulte este documento en www.sunat.gob.pe</p>
    </div>
</body>
</html>
