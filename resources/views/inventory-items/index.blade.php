@extends('adminlte::page')

@section('title', 'Inventario')

@section('content')
    <div class="container-fluid">
        <div class="p-4">
            <!-- Encabezado -->
            <div class="mb-4 bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">Inventario de Artículos</h1>
                    <p class="mt-1 text-sm text-gray-600">Gestiona los artículos del inventario</p>
                </div>
            </div>

            <!-- Barra de acciones -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <!-- Buscador -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 pl-10 text-sm bg-white border border-gray-300 rounded-lg w-80 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buscar artículos...">
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
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100" onclick="exportTable('csv')">Exportar CSV</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100" onclick="exportTable('txt')">Exportar TXT</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100" onclick="exportTable('pdf')">Exportar PDF</a></li>
                        </ul>
                    </div>

                    <a href="{{ route('inventory.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <i class="mr-2 fas fa-plus"></i>Nuevo Artículo
                    </a>
                </div>
            </div>

            <!-- Tabs de categorías -->
            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-4">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="#"
                            class="tab-button inline-block p-4 border-b-2 rounded-t-lg text-blue-600 border-blue-600"
                            onclick="changeTab('preenvasados', event)"
                            role="tab">
                            Productos para Venta
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="#"
                            class="tab-button inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-gray-600 hover:border-gray-300"
                            onclick="changeTab('ingredientes', event)"
                            role="tab">
                            Ingredientes
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contenido de las tabs -->
            <div id="preenvasados" class="tab-content">
                <!-- Artículos Preenvasados - Mantén el div existente pero elimina el título h2 -->
                <div class="bg-white rounded-lg shadow">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nombre</th>
                                    <th scope="col" class="px-6 py-3">Contenido</th>
                                    <th scope="col" class="px-6 py-3">Stock (unidades)</th>
                                    <th scope="col" class="px-6 py-3">Precio Costo</th>
                                    <th scope="col" class="px-6 py-3">Nivel Reorden</th>
                                    <th scope="col" class="px-6 py-3">Proveedor</th>
                                    <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($preenvasados as $item)
                                    <tr class="bg-white border-b hover:bg-gray-50" data-created="{{ $item->formatted_date }}">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->name }}</td>
                                        <td class="px-6 py-4">{{ $item->quantity }} {{ $item->unit->unit_name }}</td>
                                        <td class="px-6 py-4">{{ $item->num_units }}</td>
                                        <td class="px-6 py-4">{{ number_format($item->cost_price, 2) }}</td>
                                        <td class="px-6 py-4">{{ $item->reorder_level }}</td>
                                        <td class="px-6 py-4">{{ $item->supplier ? $item->supplier->name : 'N/A' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('inventory.supply', $item->id) }}"
                                                    class="text-green-400 hover:text-green-600" title="Abastecer">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                                <a href="{{ route('inventory.history', $item->id) }}"
                                                    class="text-blue-400 hover:text-blue-600" title="Historial">
                                                    <i class="fas fa-history"></i>
                                                </a>
                                                <a href="{{ route('inventory.edit', $item->id) }}"
                                                    class="text-yellow-400 hover:text-yellow-600">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('¿Estás seguro que deseas eliminar este artículo?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="px-6 py-4 text-center">No hay productos registrados</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $preenvasados->links() }}
                </div>
            </div>

            <div id="ingredientes" class="tab-content hidden">
                <!-- Ingredientes - Mantén el div existente pero elimina el título h2 -->
                <div class="bg-white rounded-lg shadow">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nombre</th>
                                    <th scope="col" class="px-6 py-3">Cantidad</th>
                                    <th scope="col" class="px-6 py-3">Unidad</th>
                                    <th scope="col" class="px-6 py-3">Precio Costo</th>
                                    <th scope="col" class="px-6 py-3">Nivel Reorden</th>
                                    <th scope="col" class="px-6 py-3">Proveedor</th>
                                    <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ingredientes as $item)
                                    <tr class="bg-white border-b hover:bg-gray-50" data-created="{{ $item->formatted_date }}">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->name }}</td>
                                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4">{{ $item->unit->unit_name }}</td>
                                        <td class="px-6 py-4">{{ number_format($item->cost_price, 2) }}</td>
                                        <td class="px-6 py-4">{{ $item->reorder_level }}</td>
                                        <td class="px-6 py-4">{{ $item->supplier ? $item->supplier->name : 'N/A' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('inventory.supply', $item->id) }}"
                                                    class="text-green-400 hover:text-green-600" title="Abastecer">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                                <a href="{{ route('inventory.history', $item->id) }}"
                                                    class="text-blue-400 hover:text-blue-600" title="Historial">
                                                    <i class="fas fa-history"></i>
                                                </a>
                                                <a href="{{ route('inventory.edit', $item->id) }}"
                                                    class="text-yellow-400 hover:text-yellow-600">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('¿Estás seguro que deseas eliminar este artículo?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="px-6 py-4 text-center">No hay ingredientes registrados</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $ingredientes->links() }}
                </div>
            </div>

            <!-- Eliminamos la paginación general anterior -->
        </div>
    </div>
@stop

@section('css')
    <style>
        .content-wrapper {
            background-color: #f8fafc;
        }
    </style>
@stop

@section('js')
    <!-- Agregar jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar antes del código existente
            window.changeTab = function(tabId, event) {
                // Remover clase activa de todos los botones
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.classList.remove('text-blue-600', 'border-blue-600');
                    button.classList.add('border-transparent');
                });

                // Agregar clase activa al botón clickeado
                event.currentTarget.classList.remove('border-transparent');
                event.currentTarget.classList.add('text-blue-600', 'border-blue-600');

                // Ocultar todos los contenidos
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });

                // Mostrar el contenido seleccionado
                document.getElementById(tabId).classList.remove('hidden');
            };

            // Resto del código existente
            const searchInput = document.getElementById('table-search');
            const dateFrom = document.getElementById('date-from');
            const dateTo = document.getElementById('date-to');
            const tables = document.querySelectorAll('table');

            function filterItems() {
                const searchTerm = searchInput.value.toLowerCase();
                const from = dateFrom.value ? new Date(dateFrom.value + 'T00:00:00') : null;
                const to = dateTo.value ? new Date(dateTo.value + 'T23:59:59') : null;

                tables.forEach(table => {
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        const rowDate = row.dataset.created ? new Date(row.dataset.created + 'T00:00:00') : null;

                        let showBySearch = text.includes(searchTerm);
                        let showByDate = true;

                        if (from && to && rowDate) {
                            // Convertir todas las fechas a timestamp para comparación
                            const fromTime = from.getTime();
                            const toTime = to.getTime();
                            const rowTime = rowDate.getTime();
                            
                            showByDate = rowTime >= fromTime && rowTime <= toTime;
                        }

                        row.style.display = showBySearch && showByDate ? '' : 'none';
                    });
                });

                // Actualizar mensaje de no resultados para cada tabla
                tables.forEach(table => {
                    const tbody = table.querySelector('tbody');
                    const visibleRows = tbody.querySelectorAll('tr:not([style*="display: none"])');
                    const noResultsRow = tbody.querySelector('.no-results');
                    
                    if (visibleRows.length === 0) {
                        if (!noResultsRow) {
                            const tr = document.createElement('tr');
                            tr.className = 'no-results';
                            tr.innerHTML = '<td colspan="7" class="px-6 py-4 text-center">No se encontraron resultados</td>';
                            tbody.appendChild(tr);
                        }
                    } else if (noResultsRow) {
                        noResultsRow.remove();
                    }
                });
            }

            searchInput.addEventListener('keyup', filterItems);
            dateFrom.addEventListener('change', filterItems);
            dateTo.addEventListener('change', filterItems);

            // Función de exportación modificada
            window.exportTable = function(format) {
                let data = [];
                
                // Procesar tabla de Productos para Venta
                const preenvasadosTable = tables[0];
                const preenvasadosRows = processTable('Productos para Venta', preenvasadosTable);
                data = data.concat(preenvasadosRows);
                
                // Agregar espacio entre tablas
                data.push(['', '', '', '', '', '']);
                
                // Procesar tabla de Ingredientes
                const ingredientesTable = tables[1];
                const ingredientesRows = processTable('Ingredientes', ingredientesTable);
                data = data.concat(ingredientesRows);

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

            function processTable(title, table) {
                let tableData = [];
                
                // Agregar título de la sección
                tableData.push([title]);
                
                // Obtener encabezados
                const headers = Array.from(table.querySelectorAll('thead th'))
                    .map(th => th.textContent.trim())
                    .slice(0, -1); // Remover columna de acciones
                tableData.push(headers);
                
                // Obtener filas visibles
                const visibleRows = Array.from(table.querySelectorAll('tbody tr'))
                    .filter(row => row.style.display !== 'none');
                
                visibleRows.forEach(row => {
                    const cells = Array.from(row.querySelectorAll('td'))
                        .map(td => td.textContent.trim())
                        .slice(0, -1); // Remover columna de acciones
                    tableData.push(cells);
                });

                return tableData;
            }

            function downloadPDF(data) {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Configuración inicial
                doc.setFontSize(18);
                doc.text('Reporte de Inventario', 14, 22);
                doc.setFontSize(11);
                doc.text(`Fecha de generación: ${new Date().toLocaleDateString()}`, 14, 30);

                let yPos = 35;
                let firstTable = true;

                // Procesar cada sección
                let currentSection = [];
                data.forEach(row => {
                    if (row.length === 1) { // Es un título de sección
                        // Si hay datos acumulados, crear tabla
                        if (currentSection.length > 0) {
                            doc.autoTable({
                                startY: yPos,
                                head: [currentSection[1]], // Encabezados
                                body: currentSection.slice(2), // Datos
                                theme: 'grid',
                                styles: { fontSize: 8, cellPadding: 2 },
                                headStyles: {
                                    fillColor: [41, 128, 185],
                                    textColor: 255
                                },
                                alternateRowStyles: {
                                    fillColor: [245, 245, 245]
                                }
                            });
                            yPos = doc.lastAutoTable.finalY + 10;
                        }

                        // Comenzar nueva sección
                        currentSection = [row];
                        doc.setFontSize(14);
                        doc.text(row[0], 14, yPos);
                        yPos += 7;
                    } else {
                        currentSection.push(row);
                    }
                });

                // Procesar última sección
                if (currentSection.length > 0) {
                    doc.autoTable({
                        startY: yPos,
                        head: [currentSection[1]],
                        body: currentSection.slice(2),
                        theme: 'grid',
                        styles: { fontSize: 8, cellPadding: 2 },
                        headStyles: {
                            fillColor: [41, 128, 185],
                            textColor: 255
                        },
                        alternateRowStyles: {
                            fillColor: [245, 245, 245]
                        }
                    });
                }

                doc.save('inventario.pdf');
            }

            function downloadCSV(data) {
                const csv = data.map(row => row.join(',')).join('\n');
                downloadFile(csv, 'inventario.csv', 'text/csv');
            }

            function downloadTXT(data) {
                const txt = data.map(row => row.join('\t')).join('\n');
                downloadFile(txt, 'inventario.txt', 'text/plain');
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
