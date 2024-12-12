@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="reportForm" class="mb-4">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo de Reporte</label>
                            <select name="report_type" class="form-control">
                                <option value="sales_by_category">Ventas por Categoría</option>
                                <option value="employee_performance">Rendimiento de Empleados</option>
                                <option value="inventory_movement">Movimiento de Inventario</option>
                                <option value="customer_analysis">Análisis de Clientes</option>
                                <!-- Más opciones según necesidad -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Inicial</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Final</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">
                                Generar
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div id="reportResult" class="mt-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table id="reportTable" class="table table-striped">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="reportChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let dataTable;
        let currentChart; // Nueva variable para mantener referencia a la gráfica actual

        $(document).ready(function() {
            $('#reportForm').on('submit', function(e) {
                e.preventDefault();
                generateReport();
            });

            // Solo mostrar estado inicial al cargar
            showInitialState();
        });

        function clearReport() {
            // Destruir solo la instancia de DataTable si existe
            if (dataTable) {
                dataTable.destroy();
            }

            // Mostrar estado inicial
            showInitialState();
        }

        function showInitialState() {
            // Establecer estructura básica de la tabla
            $('#reportTable').html(`
                <thead>
                    <tr>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">Seleccione fechas y genere el reporte</td>
                    </tr>
                </tbody>
            `);

            // Asegurarse de destruir la gráfica anterior
            if (currentChart) {
                currentChart.destroy();
            }
            
            // Crear gráfica inicial
            createChart({
                series: [{
                    name: 'Esperando datos',
                    data: [0]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: { horizontal: true }
                },
                xaxis: {
                    categories: ['Genere un reporte para ver datos']
                }
            });
        }

        function generateReport() {
            const formData = new FormData(document.getElementById('reportForm'));
            
            // Mostrar indicador de carga
            Swal.fire({
                title: 'Generando reporte...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: '{{ route('reports.generate') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.close();
                    
                    if (response.error) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Sin datos',
                            text: response.message
                        });
                        clearReport();
                        return;
                    }
                    
                    displayReport(response.data, formData.get('report_type'));
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al generar el reporte'
                    });
                    clearReport();
                }
            });
        }

        function displayReport(data, reportType) {
            if (!data || data.length === 0) {
                showInitialState();
                return;
            }

            switch(reportType) {
                case 'sales_by_category':
                    displaySalesByCategoryReport(data);
                    break;
                case 'employee_performance':
                    displayEmployeePerformanceReport(data);
                    break;
                case 'inventory_movement':
                    displayInventoryMovementReport(data);
                    break;
                case 'customer_analysis':
                    displayCustomerAnalysisReport(data);
                    break;
                default:
                    clearReport();
            }
        }

        function createChart(options) {
            const chartElement = document.querySelector("#reportChart");
            chartElement.innerHTML = ''; // Limpiar el contenedor
            
            // Destruir la gráfica anterior si existe
            if (currentChart) {
                currentChart.destroy();
            }
            
            // Crear nueva gráfica y guardar referencia
            currentChart = new ApexCharts(chartElement, options);
            return currentChart.render();
        }

        function displaySalesByCategoryReport(data) {
            const columns = [
                { title: "Categoría" },
                { title: "Total Ventas (S/.)" },
                { title: "N° Órdenes" }
            ];

            const tableData = data.map(row => [
                row.name,
                parseFloat(row.total_sales).toFixed(2),
                row.total_orders
            ]);

            initializeDataTableWithData(columns, tableData);

            createChart({
                series: [{
                    name: 'Ventas Totales',
                    data: data.map(row => parseFloat(row.total_sales))
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return 'S/. ' + val.toFixed(2);
                    }
                },
                xaxis: {
                    categories: data.map(row => row.name)
                },
                colors: ['#6366f1']
            });
        }

        // Función helper para inicializar DataTable con datos
        function initializeDataTableWithData(columns, data) {
            if (dataTable) {
                dataTable.destroy();
            }

            const table = $('#reportTable');
            
            // Construir tabla completa de una vez
            table.html(`
                <thead>
                    <tr>${columns.map(col => `<th>${col.title}</th>`).join('')}</tr>
                </thead>
                <tbody>
                    ${data.map(row => `
                        <tr>${row.map(cell => `<td>${cell}</td>`).join('')}</tr>
                    `).join('')}
                </tbody>
            `);

            // Inicializar DataTable
            dataTable = table.DataTable({
                destroy: true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                }
            });
        }

        // Actualizar las otras funciones display siguiendo el mismo patrón
        function displayEmployeePerformanceReport(data) {
            const columns = [
                { title: "Empleado" },
                { title: "Total Órdenes" },
                { title: "Total Ventas (S/.)" }
            ];

            const tableData = data.map(row => [
                row.name,
                row.total_orders,
                parseFloat(row.total_sales).toFixed(2)
            ]);

            initializeDataTableWithData(columns, tableData);
            
            createChart({
                series: [{
                    name: 'Ventas Totales',
                    data: data.map(row => parseFloat(row.total_sales))
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: { bar: { horizontal: true } },
                // ...resto de las opciones de la gráfica...
            });
        }

        function displayInventoryMovementReport(data) {
            const columns = [
                { title: "Producto" },
                { title: "Stock Actual" },
                { title: "Nivel Mínimo" },
                { title: "Entradas" },
                { title: "Salidas" }
            ];

            const tableData = data.map(row => [
                row.name,
                row.current_stock,
                row.reorder_level,
                row.total_inputs,
                row.total_outputs
            ]);

            initializeDataTableWithData(columns, tableData);

            createChart({
                series: [{
                    name: 'Stock Actual',
                    data: data.map(row => row.current_stock)
                }, {
                    name: 'Nivel Mínimo',
                    data: data.map(row => row.reorder_level)
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                xaxis: {
                    categories: data.map(row => row.name),
                },
                colors: ['#1a56db', '#dc2626']
            });
        }

        function displayCustomerAnalysisReport(data) {
            const columns = [
                { title: "Cliente" },
                { title: "Total Órdenes" },
                { title: "Total Gastado (S/.)" },
                { title: "Promedio por Orden (S/.)" }
            ];

            const tableData = data.map(row => [
                row.name,
                row.total_orders,
                parseFloat(row.total_spent).toFixed(2),
                parseFloat(row.average_order).toFixed(2)
            ]);

            initializeDataTableWithData(columns, tableData);

            createChart({
                series: [{
                    name: 'Total Gastado',
                    data: data.map(row => parseFloat(row.total_spent))
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return 'S/. ' + val.toFixed(2);
                    }
                },
                xaxis: {
                    categories: data.map(row => row.name)
                },
                colors: ['#f59e0b']
            });
        }

        function initializeDataTable() {
            if (dataTable) {
                dataTable.destroy();
            }
            
            dataTable = $('#reportTable').DataTable({
                retrieve: true,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                },
                responsive: true,
                drawCallback: function() {
                    this.api().columns.adjust();
                }
            });
        }
    </script>
@stop

