@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-utensils"></i> BIENVENIDOS</h1>
@stop

@section('content')
    {{-- Banner opcional --}}
    {{-- <div class="mb-4 text-center">
        <img src="vendor/adminlte/dist/img/Fondo1.jpeg" alt="logo" style="width: 1150px; height: 500px;">
    </div> --}}

    {{-- Mostrar todos los datos en JSON --}}
    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dashboard Data - JSON Format</h3>
        </div>
        <div class="card-body">
            <pre>
            {!! json_encode(
                [
                    'ventas_totales' => number_format($salesTotal, 2),
                    'pedidos_hoy' => $ordersToday,
                    'ventas_diarias' => [
                        'fechas' => $salesDatesLabels,
                        'totales' => $salesTotals,
                        'maximo_eje_y' => $yAxisMax,
                    ],
                    'inventario' => [
                        'productos' => $inventoryItems,
                        'niveles_stock' => $inventoryLevels,
                    ],
                ],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE,
            ) !!}
        </pre>
        </div>
    </div> --}}

    <div class="container-fluid">
        <div class="row">
            <!-- Ventas Totales -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($salesTotal, 2) }}</h3>
                        <p>Ventas Totales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>

            <!-- Pedidos Hoy -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $ordersToday }}</h3>
                        <p>Pedidos Hoy</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <!-- Inventario Bajo Nivel -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $inventoryStatus }}</h3>  <!-- Removido el ->count() -->
                        <p>Artículos a Reabastecer</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficas -->
        <div class="mt-4 row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ventas Diarias</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Estado de Inventario</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="inventoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Agrega estilos personalizados aquí si es necesario --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Gráfica de Ventas Diarias para los últimos 7 días
            var ctxSales = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctxSales, {
                type: 'line',
                data: {
                    labels: @json($salesDatesLabels),
                    datasets: [{
                        label: 'Ventas Diarias',
                        data: @json($salesTotals),
                        borderWidth: 2,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category'
                        },
                        y: {
                            beginAtZero: true,
                            max: @json($yAxisMax) // Límite superior de Ventas Diarias
                        }
                    }
                }
            });
            // Gráfica de Estado de Inventario
            var ctxInventory = document.getElementById('inventoryChart').getContext('2d');
            var inventoryChart = new Chart(ctxInventory, {
                type: 'bar',
                data: {
                    labels: @json($inventoryItems),
                    datasets: [{
                        label: 'Nivel de Inventario',
                        data: @json($inventoryLevels),
                        borderWidth: 1,
                        backgroundColor: function(context) {
                            const inventory = @json($inventoryLevels);
                            const reorderLevel = @json($reorderLevels);
                            const index = context.dataIndex;
                            // Rojo si está por debajo del nivel de reorden
                            // Amarillo si está cerca del nivel de reorden
                            // Verde si está bien abastecido
                            if (inventory[index] <= reorderLevel[index]) {
                                return 'rgba(255, 99, 132, 0.5)'; // Rojo
                            } else if (inventory[index] <= reorderLevel[index] * 1.2) {
                                return 'rgba(255, 205, 86, 0.5)'; // Amarillo
                            }
                            return 'rgba(75, 192, 192, 0.5)'; // Verde
                        },
                        borderColor: 'rgba(255, 159, 64, 1)',
                    }, {
                        label: 'Nivel de Reorden',
                        data: @json($reorderLevels),
                        type: 'line',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderDash: [5, 5],
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true,
                            max: @json($yAxisInventoryMax)
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const inventory = context.raw;
                                    const reorderLevel = @json($reorderLevels)[context.dataIndex];
                                    let status = '';
                                    if (inventory <= reorderLevel) {
                                        status = ' ⚠️ Requiere reabastecimiento';
                                    } else if (inventory <= reorderLevel * 1.2) {
                                        status = ' ⚠️ Nivel bajo';
                                    }
                                    return `Cantidad: ${inventory}${status}`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

@stop
