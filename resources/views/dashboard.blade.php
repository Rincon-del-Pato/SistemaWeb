@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-utensils"></i> BIENVENIDOS</h1>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Filtros y botones de exportación -->
        <div class="p-4 mb-4 bg-white rounded-lg shadow-md">
            <form action="{{ route('dashboard.filter') }}" method="POST" class="flex flex-wrap items-end gap-4">
                @csrf
                <div class="flex-1 min-w-[200px]">
                    <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha Inicial</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha Final</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Filtrar
                    </button>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('dashboard.export-sales', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]) }}"
                        class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Exportar Ventas
                    </a>
                    <a href="{{ route('dashboard.export-inventory') }}"
                        class="px-5 py-2.5 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                        Exportar Inventario
                    </a>
                </div>
            </form>
        </div>

        <!-- Resto del contenido existente -->
        <div class="grid gap-6 mb-8 md:grid-cols-3">
            <!-- Ventas Totales -->
            <div class="relative overflow-hidden rounded-lg shadow-lg bg-info group">
                <div class="p-6">
                    <div class="relative z-10">
                        <div class="text-2xl font-bold text-white">
                            S/. {{ number_format($salesTotal, 2) }}
                        </div>
                        <div class="text-white/90">
                            Ventas Totales
                        </div>
                    </div>
                    <div class="absolute right-0 transition-transform opacity-50 top-2 text-white/50 group-hover:scale-110">
                        <i class="mr-4 text-6xl transform fas fa-dollar-sign -rotate-12"></i>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            </div>

            <!-- Pedidos Hoy -->
            <div class="relative overflow-hidden rounded-lg shadow-lg bg-success group">
                <div class="p-6">
                    <div class="relative z-10">
                        <div class="text-2xl font-bold text-white">
                            {{ $ordersToday }}
                        </div>
                        <div class="text-white/90">
                            Pedidos Hoy
                        </div>
                    </div>
                    <div class="absolute right-0 transition-transform opacity-50 top-2 text-white/50 group-hover:scale-110">
                        <i class="mr-4 text-6xl transform fas fa-shopping-cart -rotate-12"></i>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            </div>

            <!-- Inventario Bajo Nivel -->
            <div class="relative overflow-hidden rounded-lg shadow-lg bg-warning group">
                <div class="p-6">
                    <div class="relative z-10">
                        <div class="text-2xl font-bold text-white">
                            {{ $inventoryStatus }}
                        </div>
                        <div class="text-white/90">
                            Artículos a Reabastecer
                        </div>
                    </div>
                    <div class="absolute right-0 transition-transform opacity-50 top-2 text-white/50 group-hover:scale-110">
                        <i class="mr-4 text-6xl transform fas fa-box -rotate-12"></i>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20"></div>
            </div>
        </div>

        <!-- Gráficas -->
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-xl font-semibold text-gray-900">Ventas Diarias</h3>
                <div id="salesChart"></div>
            </div>
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-xl font-semibold text-gray-900">Estado de Inventario</h3>
                <div id="inventoryChart"></div>
            </div>
        </div>
    </div>

    <!-- Modal de Ayuda -->
    <div id="helpModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Encabezado del Modal -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Ayuda del Sistema de Restaurante
                    </h3>
                    <button type="button" onclick="closeHelpModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <!-- Contenido del Modal -->
                <div class="p-6 space-y-6">
                    <div class="mb-4">
                        <h4 class="text-lg font-bold text-gray-900">Dashboard</h4>
                        <p class="text-gray-700">Visualización general de estadísticas y métricas importantes del restaurante.</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-bold text-gray-900">Filtros de Fecha</h4>
                        <p class="text-gray-700">Use los selectores de fecha para filtrar la información mostrada en el dashboard.</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-bold text-gray-900">Exportación</h4>
                        <p class="text-gray-700">Utilice los botones de exportación para descargar reportes de ventas e inventario.</p>
                    </div>
                </div>
                <!-- Pie del Modal -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                    <button onclick="closeHelpModal()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Entendido</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Inicializar el modal
        let helpModal;

        document.addEventListener('DOMContentLoaded', function() {
            // Gráfica de Ventas Diarias
            const salesOptions = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: false,
                    }
                },
                series: [{
                    name: 'Ventas Diarias',
                    data: @json($salesTotals)
                }],
                xaxis: {
                    categories: @json($salesDatesLabels),
                    labels: {
                        style: {
                            colors: '#9ca3af'
                        }
                    }
                },
                yaxis: {
                    max: @json($yAxisMax),
                    labels: {
                        style: {
                            colors: '#9ca3af'
                        }
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#1a56db'],
                theme: {
                    mode: 'light'
                }
            };

            new ApexCharts(document.querySelector("#salesChart"), salesOptions).render();

            // Gráfica de Inventario
            const inventoryOptions = {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false,
                    }
                },
                series: [{
                    name: 'Nivel de Inventario',
                    data: @json($inventoryLevels)
                }, {
                    name: 'Nivel de Reorden',
                    type: 'line',
                    data: @json($reorderLevels)
                }],
                xaxis: {
                    categories: @json($inventoryItems),
                    labels: {
                        style: {
                            colors: '#9ca3af'
                        }
                    }
                },
                yaxis: {
                    max: @json($yAxisInventoryMax),
                    labels: {
                        style: {
                            colors: '#9ca3af'
                        }
                    }
                },
                colors: ['#1a56db', '#dc2626'],
                plotOptions: {
                    bar: {
                        borderRadius: 3
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [0, 2]
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: [{
                        formatter: function(value) {
                            return value + " unidades";
                        }
                    }, {
                        formatter: function(value) {
                            return "Nivel mínimo: " + value;
                        }
                    }]
                }
            };

            new ApexCharts(document.querySelector("#inventoryChart"), inventoryOptions).render();

            // Inicializar el modal
            helpModal = new Modal(document.getElementById('helpModal'));

            // Manejador de F1
            document.addEventListener('keydown', function(event) {
                if (event.key === 'F1') {
                    event.preventDefault();
                    helpModal.show();
                }
            });
        });

        // Función para cerrar el modal
        function closeHelpModal() {
            if (helpModal) {
                helpModal.hide();
            }
        }
    </script>
@stop
