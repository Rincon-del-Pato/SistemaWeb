@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="pt-4 mb-4 text-2xl font-semibold">Roles</h1>

        <!-- Filtros y Acciones -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-4">
                <!-- Buscador -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block pt-2 text-sm bg-white border border-gray-300 rounded-lg ps-10 w-80 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Buscar roles...">
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
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownExport" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownExportButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                onclick="exportTable('csv')">Exportar CSV</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                onclick="exportTable('txt')">Exportar TXT</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                onclick="exportTable('pdf')">Exportar PDF</a>
                        </li>
                    </ul>
                </div>

                <!-- Botón Agregar -->
                <a href="{{ route('roles.create') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300">
                    <i class="mr-2 fas fa-plus"></i>Agregar Roles
                </a>
            </div>
        </div>

        <!-- Tabla con bordes más sutiles -->
        <div class="bg-white rounded-lg shadow">
            <table class="w-full text-base text-left text-gray-600">
                <thead class="text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-center border-b">Nº</th>
                        <th scope="col" class="px-6 py-4 border-b">Rol</th>
                        <th scope="col" class="px-6 py-4 text-center border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr class="border-b hover:bg-gray-50" data-created="{{ $rol->formatted_date }}">
                            <td class="px-6 py-4 text-center">{{ $rol->id }}</td>
                            <td class="px-6 py-4">{{ $rol->description }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('roles.destroy', $rol) }}" method="POST" class="inline-flex gap-2">
                                    <a href="{{ route('roles.edit', $rol) }}"
                                        class="text-yellow-400 text-l hover:text-yellow-600">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 text-l hover:text-red-900"
                                        onclick="return confirm('¿Estás seguro de eliminar este rol?')">
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
        <div class="flex items-center justify-between mt-4">
            <!-- Texto informativo -->
            <span class="text-base text-gray-700">
                Mostrando
                <span class="font-semibold text-gray-900">{{ $roles->firstItem() }}</span>
                a
                <span class="font-semibold text-gray-900">{{ $roles->lastItem() }}</span>
                de
                <span class="font-semibold text-gray-900">{{ $roles->total() }}</span>
                roles
            </span>

            <!-- Navegación de páginas -->
            <nav aria-label="Page navigation">
                <ul class="inline-flex -space-x-px text-base">
                    <!-- Botón Anterior -->
                    <li>
                        <a href="{{ $roles->previousPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 {{ $roles->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Anterior
                        </a>
                    </li>

                    {{-- Números de página --}}
                    @for ($i = 1; $i <= $roles->lastPage(); $i++)
                        <li>
                            <a href="{{ $roles->url($i) }}"
                                class="flex items-center justify-center px-4 h-10 leading-tight {{ $roles->currentPage() == $i
                                    ? 'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                    : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <!-- Botón Siguiente -->
                    <li>
                        <a href="{{ $roles->nextPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 {{ !$roles->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('table-search');
            const noResultsMessage = document.createElement('div');
            noResultsMessage.className = 'text-center py-4 text-gray-500';
            noResultsMessage.textContent = 'No se encontraron roles';
            noResultsMessage.style.display = 'none';

            const tableBody = document.querySelector('tbody');
            tableBody.parentNode.insertBefore(noResultsMessage, tableBody.nextSibling);

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const tableRows = document.querySelectorAll('tbody tr');
                let visibleRows = 0;

                tableRows.forEach(row => {
                    const roleText = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const shouldShow = roleText.includes(searchTerm);
                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleRows++;
                });

                // Mostrar/ocultar mensaje de no resultados
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
                // Encabezados - ajustados para la tabla de roles
                const headers = ['ID', 'Rol'];
                data.push(headers);

                // Datos de las filas - ajustados para la tabla de roles
                rows.forEach(row => {
                    const cols = row.querySelectorAll('td');
                    const rowData = [
                        cols[0].textContent.trim(), // ID
                        cols[1].textContent.trim(), // Nombre del rol
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
                downloadFile(csv, 'roles.csv', 'text/csv');
            }

            function downloadTXT(data) {
                const txt = data.map(row => row.join('\t')).join('\n');
                downloadFile(txt, 'roles.txt', 'text/plain');
            }

            function downloadPDF(data) {
                // Inicializar jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Configurar el título
                doc.setFontSize(18);
                doc.text('Reporte de Roles', 14, 22);

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
                doc.save('roles.pdf');
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
