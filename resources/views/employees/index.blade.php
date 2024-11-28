@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="pt-4 mb-4 text-2xl font-semibold">Empleados</h1>

        <!-- Filtros y Acciones -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-4">
                <!-- Buscador -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block pt-2 text-sm bg-white border border-gray-300 rounded-lg ps-10 w-80 focus:ring-blue-500 focus:border-blue-500" placeholder="Buscar empleados...">
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
                <button id="dropdownExportButton" data-dropdown-toggle="dropdownExport" class="text-gray-500 bg-white hover:bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">
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

                <!-- Botón Agregar -->
                <a href="{{ route('employees.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300">
                    <i class="mr-2 fas fa-plus"></i>Agregar Empleado
                </a>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-lg shadow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Nº</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Empleado</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">DNI</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Celular</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Rol</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($employees as $employee)
                            <tr class="hover:bg-gray-50" data-created="{{ $employee->formatted_date }}">
                                <td class="px-6 py-4 text-sm text-center text-gray-500">{{ $employee->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{-- <img src="{{ asset('storage/' . $employee->user()->first()->profile_photo_path) }}' --}}
                                        <img src="{{ asset($employee->user()->first()->profile_photo_path) }}"
                                            class="w-10 h-10 mr-3 rounded-full" alt="{{ $employee->user()->first()->name }}">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $employee->user()->first()->name }} {{ $employee->lastname }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $employee->user()->first()->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $employee->dni }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $employee->phone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $employee->user->getRoleNames()->implode(', ') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-flex gap-2">
                                        <a href="{{ route('employees.edit', $employee) }}"
                                            class="text-yellow-400 hover:text-yellow-600">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('employees.show', $employee) }}"
                                            class="text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div class="flex items-center justify-between mt-4">
            <span class="text-base text-gray-700">
                Mostrando
                <span class="font-semibold text-gray-900">{{ $employees->firstItem() }}</span>
                a
                <span class="font-semibold text-gray-900">{{ $employees->lastItem() }}</span>
                de
                <span class="font-semibold text-gray-900">{{ $employees->total() }}</span>
                empleados
            </span>

            <nav aria-label="Page navigation">
                <ul class="inline-flex -space-x-px text-base">
                    <!-- Botón Anterior -->
                    <li>
                        <a href="{{ $employees->previousPageUrl() }}"
                           class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 {{ $employees->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Anterior
                        </a>
                    </li>

                    {{-- Números de página --}}
                    @for ($i = 1; $i <= $employees->lastPage(); $i++)
                        <li>
                            <a href="{{ $employees->url($i) }}"
                               class="flex items-center justify-center px-4 h-10 leading-tight {{ $employees->currentPage() == $i
                               ? 'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                               : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <!-- Botón Siguiente -->
                    <li>
                        <a href="{{ $employees->nextPageUrl() }}"
                           class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 {{ !$employees->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('table-search');
            const noResultsMessage = document.createElement('div');
            noResultsMessage.className = 'text-center py-4 text-gray-500';
            noResultsMessage.textContent = 'No se encontraron empleados';
            noResultsMessage.style.display = 'none';

            const tableBody = document.querySelector('tbody');
            tableBody.parentNode.insertBefore(noResultsMessage, tableBody.nextSibling);

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const tableRows = document.querySelectorAll('tbody tr');
                let visibleRows = 0;

                tableRows.forEach(row => {
                    const employeeText = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const shouldShow = employeeText.includes(searchTerm);
                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleRows++;
                });

                noResultsMessage.style.display = visibleRows === 0 ? 'block' : 'none';
            });

            // Función para exportar la tabla
            window.exportTable = function(format) {
                const table = document.querySelector('table');
                const rows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');

                // Obtener fechas seleccionadas
                const dateFrom = document.getElementById('date-from').value;
                const dateTo = document.getElementById('date-to').value;

                let data = [];
                // Encabezados
                const headers = ['ID', 'Nombre', 'Email', 'DNI', 'Celular', 'Rol'];
                data.push(headers);

                // Datos de las filas
                rows.forEach(row => {
                    const cols = row.querySelectorAll('td');
                    const rowData = [
                        cols[0].textContent.trim(),
                        cols[1].querySelector('.text-gray-900').textContent.trim(),
                        cols[1].querySelector('.text-gray-500').textContent.trim(),
                        cols[2].textContent.trim(),
                        cols[3].textContent.trim(),
                        cols[4].textContent.trim()
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
                downloadFile(csv, 'empleados.csv', 'text/csv');
            }

            function downloadTXT(data) {
                const txt = data.map(row => row.join('\t')).join('\n');
                downloadFile(txt, 'empleados.txt', 'text/plain');
            }

            function downloadPDF(data) {
                // Inicializar jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Configurar el título
                doc.setFontSize(18);
                doc.text('Reporte de Empleados', 14, 22);

                // Agregar fecha de generación
                doc.setFontSize(11);
                doc.text(`Fecha de generación: ${new Date().toLocaleDateString()}`, 14, 30);

                // Generar la tabla
                doc.autoTable({
                    head: [data[0]], // Usar la primera fila como encabezados
                    body: data.slice(1), // Usar el resto de los datos como cuerpo
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

                // Guardar el PDF
                doc.save('empleados.pdf');
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

            // Filtrado por fechas
            const dateFrom = document.getElementById('date-from');
            const dateTo = document.getElementById('date-to');

            function filterByDate() {
                const rows = document.querySelectorAll('tbody tr');

                // Si alguna fecha está vacía, mostrar todas las filas
                if (!dateFrom.value || !dateTo.value) {
                    rows.forEach(row => {
                        row.style.display = '';
                    });
                    return;
                }

                const from = new Date(dateFrom.value);
                const to = new Date(dateTo.value);

                // Ajustar las fechas para incluir todo el día
                from.setHours(0, 0, 0, 0);
                to.setHours(23, 59, 59, 999);

                rows.forEach(row => {
                    const utcDate = new Date(row.dataset.created);
                    const localDate = new Date(utcDate.getTime() - utcDate.getTimezoneOffset() * 60000);
                    localDate.setHours(0, 0, 0, 0);

                    const dateToCompare = localDate.getTime();
                    const fromTime = from.getTime();
                    const toTime = to.getTime();

                    row.style.display = (dateToCompare >= fromTime && dateToCompare <= toTime) ? '' : 'none';
                });
            }

            dateFrom.addEventListener('change', filterByDate);
            dateTo.addEventListener('change', filterByDate);
        });
    </script>

    <!-- Agregar jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
@stop
