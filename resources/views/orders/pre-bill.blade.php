
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pre-Cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .restaurant-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .info {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="restaurant-name">{{ config('app.name', 'Restaurante') }}</div>
        <div>Pre-Cuenta</div>
    </div>

    <div class="info">
        <p>Mesa: {{ $order->table->table_number }}</p>
        <p>Mozo: {{ $order->user->name }}</p>
        <p>Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p>Orden #: {{ $order->id }}</p>
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
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->menuItem->name }}</td>
                <td>S/. {{ number_format($item->price, 2) }}</td>
                <td>S/. {{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total: S/. {{ number_format($order->total, 2) }}
    </div>

    <div class="footer">
        <p>Esta no es una boleta o factura electrónica</p>
        <p>Es solo una pre-cuenta para su verificación</p>
    </div>
</body>
</html>
