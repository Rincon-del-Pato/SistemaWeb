@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="text-2xl font-semibold pt-4 mb-4">Mesas</h1>

        <!-- Barra de búsqueda y botón -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-4">
                <!-- Buscador -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block pt-2 ps-10 text-sm border border-gray-300 rounded-lg w-80 bg-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Buscar mesas...">
                </div>

                <!-- Selector de Fechas -->
                <div class="flex items-center gap-2">
                    <input type="date" id="date-from" class="text-sm border border-gray-300 rounded-lg p-2">
                    <span class="text-gray-500">hasta</span>
                    <input type="date" id="date-to" class="text-sm border border-gray-300 rounded-lg p-2">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <!-- Dropdown de Exportación -->
                <button id="dropdownExportButton" data-dropdown-toggle="dropdownExport"
                    class="text-gray-500 bg-white hover:bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center"
                    type="button">
                    <i class="fas fa-download mr-2"></i>
                    Exportar
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div id="dropdownExport" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownExportButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100" onclick="exportTable('csv')">Exportar CSV</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100" onclick="exportTable('txt')">Exportar TXT</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100" onclick="exportTable('pdf')">Exportar PDF</a>
                        </li>
                    </ul>
                </div>

                <!-- Botón Agregar Mesa -->
                <a href="{{ route('tables.create') }}"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                    <i class="fas fa-plus mr-2"></i>Agregar Mesa
                </a>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mesa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacidad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($tables as $table)
                        <tr class="hover:bg-gray-50" data-created="{{ $table->formatted_date }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-table text-gray-400 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">{{ $table->table_number }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-gray-400 mr-2"></i>
                                    <span class="text-sm text-gray-900">{{ $table->seating_capacity }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="flex items-center">
                                    <i class="fas fa-circle mr-2 text-{{ $table->status->value === 'Disponible' ? 'green' : ($table->status->value === 'Ocupado' ? 'red' : 'yellow') }}-500"></i>
                                    <span class="text-sm text-gray-900">{{ $table->status->value }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form action="{{ route('tables.destroy', $table->id) }}" method="POST" class="inline-flex gap-2">
                                    <a href="{{ route('tables.edit', $table->id) }}"
                                        class="text-yellow-400 hover:text-yellow-600">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta mesa?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="flex justify-between items-center mt-4">
            <span class="text-base text-gray-700">
                Mostrando
                <span class="font-semibold text-gray-900">{{ $tables->firstItem() }}</span>
                a
                <span class="font-semibold text-gray-900">{{ $tables->lastItem() }}</span>
                de
                <span class="font-semibold text-gray-900">{{ $tables->total() }}</span>
                mesas
            </span>

            <nav aria-label="Page navigation">
                <ul class="inline-flex -space-x-px text-base">
                    <!-- Botón Anterior -->
                    <li>
                        <a href="{{ $tables->previousPageUrl() }}"
                           class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 {{ $tables->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Anterior
                        </a>
                    </li>

                    {{-- Números de página --}}
                    @for ($i = 1; $i <= $tables->lastPage(); $i++)
                        <li>
                            <a href="{{ $tables->url($i) }}"
                               class="flex items-center justify-center px-4 h-10 leading-tight {{ $tables->currentPage() == $i
                               ? 'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                               : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <!-- Botón Siguiente -->
                    <li>
                        <a href="{{ $tables->nextPageUrl() }}"
                           class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 {{ !$tables->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@stop

@section('js')
    <!-- Agregar jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('table-search');
            const noResultsMessage = document.createElement('div');
            noResultsMessage.className = 'text-center py-4 text-gray-500';
            noResultsMessage.textContent = 'No se encontraron mesas';
            noResultsMessage.style.display = 'none';

            const tableBody = document.querySelector('tbody');
            tableBody.parentNode.insertBefore(noResultsMessage, tableBody.nextSibling);

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const tableRows = document.querySelectorAll('tbody tr');
                let visibleRows = 0;

                tableRows.forEach(row => {
                    // Buscar en número de mesa y capacidad
                    const mesaText = row.querySelector('td:nth-child(1) span').textContent.toLowerCase();
                    const capacidadText = row.querySelector('td:nth-child(2) span').textContent.toLowerCase();
                    const estadoText = row.querySelector('td:nth-child(3) span span').textContent.toLowerCase();

                    const shouldShow = mesaText.includes(searchTerm) ||
                                     capacidadText.includes(searchTerm) ||
                                     estadoText.includes(searchTerm);

                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleRows++;
                });

                noResultsMessage.style.display = visibleRows === 0 ? 'block' : 'none';
            });

            // Filtrado por fechas
            const dateFrom = document.getElementById('date-from');
            const dateTo = document.getElementById('date-to');

            function filterByDate() {
                const rows = document.querySelectorAll('tbody tr');
                let visibleRows = 0;

                if (!dateFrom.value || !dateTo.value) {
                    rows.forEach(row => {
                        row.style.display = '';
                        visibleRows++;
                    });
                } else {
                    const from = new Date(dateFrom.value);
                    const to = new Date(dateTo.value);

                    from.setHours(0, 0, 0, 0);
                    to.setHours(23, 59, 59, 999);

                    rows.forEach(row => {
                        const utcDate = new Date(row.dataset.created);
                        const localDate = new Date(utcDate.getTime() - utcDate.getTimezoneOffset() * 60000);
                        localDate.setHours(0, 0, 0, 0);

                        const dateToCompare = localDate.getTime();
                        const fromTime = from.getTime();
                        const toTime = to.getTime();

                        const shouldShow = (dateToCompare >= fromTime && dateToCompare <= toTime);
                        row.style.display = shouldShow ? '' : 'none';
                        if (shouldShow) visibleRows++;
                    });
                }

                noResultsMessage.style.display = visibleRows === 0 ? 'block' : 'none';
            }

            dateFrom.addEventListener('change', filterByDate);
            dateTo.addEventListener('change', filterByDate);

            // Función para exportar la tabla
            window.exportTable = function(format) {
                const table = document.querySelector('table');
                const rows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');

                let data = [];
                // Encabezados
                const headers = ['Mesa', 'Capacidad', 'Estado'];
                data.push(headers);

                // Datos de las filas
                rows.forEach(row => {
                    const rowData = [
                        row.querySelector('td:nth-child(1) span').textContent.trim(),
                        row.querySelector('td:nth-child(2) span').textContent.trim(),
                        row.querySelector('td:nth-child(3) span span').textContent.trim()
                    ];
                    data.push(rowData);
                });

                switch(format) {
                    case 'csv':
                        downloadCSV(data);
                        break;
                    case 'txt':
                        downloadTXT(data);
                        break;
                    case 'pdf':
                        downloadPDF(data);
                        break;
                }
            }

            function downloadCSV(data) {
                const csv = data.map(row => row.join(',')).join('\n');
                downloadFile(csv, 'mesas.csv', 'text/csv');
            }

            function downloadTXT(data) {
                const txt = data.map(row => row.join('\t')).join('\n');
                downloadFile(txt, 'mesas.txt', 'text/plain');
            }

            function downloadPDF(data) {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                doc.setFontSize(18);
                doc.text('Reporte de Mesas', 14, 22);

                doc.setFontSize(11);
                doc.text(`Fecha de generación: ${new Date().toLocaleDateString()}`, 14, 30);

                doc.autoTable({
                    head: [data[0]],
                    body: data.slice(1),
                    startY: 35,
                    theme: 'grid',
                    styles: {
                        fontSize: 8,
                        cellPadding: 2,
                    },
                    headStyles: {
                        fillColor: [41, 128, 185],
                        textColor: 255
                    },
                    alternateRowStyles: {
                        fillColor: [245, 245, 245]
                    }
                });

                doc.save('mesas.pdf');
            }

            function downloadFile(content, fileName, mimeType) {
                const blob = new Blob([content], { type: mimeType });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = fileName;
                a.click();
                window.URL.revokeObjectURL(url);
            }
        });
    </script>
@stop
