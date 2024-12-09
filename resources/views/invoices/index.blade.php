@extends('adminlte::page')

@section('title', 'Comprobantes')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="pt-4 mb-4 text-2xl font-semibold">Comprobantes</h1>

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
                        placeholder="Buscar comprobantes...">
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
                <button id="dropdownExportButton" data-dropdown-toggle="dropdownExport" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center">
                    <i class="fas fa-download mr-2"></i>
                    Exportar
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownExport" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownExportButton">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                onclick="exportTable('csv')">Exportar CSV</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                onclick="exportTable('txt')">Exportar TXT</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                onclick="exportTable('pdf')">Exportar PDF</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-lg shadow">
            <table class="w-full text-base text-left text-gray-600">
                <thead class="text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 border-b">Serie-Número</th>
                        <th scope="col" class="px-6 py-4 border-b">Tipo</th>
                        <th scope="col" class="px-6 py-4 border-b">Cliente</th>
                        <th scope="col" class="px-6 py-4 border-b">Fecha</th>
                        <th scope="col" class="px-6 py-4 border-b">Total</th>
                        <th scope="col" class="px-6 py-4 text-center border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr class="border-b hover:bg-gray-50" data-created="{{ $invoice->issue_date }}">
                            <td class="px-6 py-4">
                                {{ $invoice->series }}-{{ str_pad($invoice->number, 8, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4">{{ $invoice->formatted_type }}</td>
                            <td class="px-6 py-4">{{ $invoice->customer_name }}</td>
                            <td class="px-6 py-4">{{ $invoice->issue_date->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">S/ {{ number_format($invoice->total, 2) }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Botón para ver modal -->
                                    <button onclick="showInvoiceModal({{ $invoice->id }})"
                                        class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Botón para imprimir PDF -->
                                    <a href="{{ route('invoices.print', $invoice) }}"
                                        class="text-green-600 hover:text-green-900" target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="flex items-center justify-between mt-4">
            <span class="text-base text-gray-700">
                Mostrando
                <span class="font-semibold text-gray-900">{{ $invoices->firstItem() }}</span>
                a
                <span class="font-semibold text-gray-900">{{ $invoices->lastItem() }}</span>
                de
                <span class="font-semibold text-gray-900">{{ $invoices->total() }}</span>
                comprobantes
            </span>

            {{ $invoices->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div id="invoiceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-xl font-bold">Detalles del Comprobante</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modalContent" class="mt-4">
                <!-- El contenido se cargará dinámicamente -->
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
@stop

@section('js')
    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('table-search');
            const noResultsMessage = document.createElement('div');
            noResultsMessage.className = 'text-center py-4 text-gray-500';
            noResultsMessage.textContent = 'No se encontraron comprobantes';
            noResultsMessage.style.display = 'none';

            const tableBody = document.querySelector('tbody');
            tableBody.parentNode.insertBefore(noResultsMessage, tableBody.nextSibling);

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const tableRows = document.querySelectorAll('tbody tr');
                let visibleRows = 0;

                tableRows.forEach(row => {
                    const serieNumber = row.querySelector('td:nth-child(1)').textContent
                        .toLowerCase();
                    const type = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const customer = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                    const shouldShow = serieNumber.includes(searchTerm) ||
                        type.includes(searchTerm) ||
                        customer.includes(searchTerm);

                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleRows++;
                });

                noResultsMessage.style.display = visibleRows === 0 ? 'block' : 'none';
            });

            // Función para exportar la tabla
            window.exportTable = function(format) {
                const table = document.querySelector('table');
                const rows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !==
                    'none');

                const dateFrom = document.getElementById('date-from').value;
                const dateTo = document.getElementById('date-to').value;

                // Configurar encabezados con el período de fechas
                let title = 'Reporte de Comprobantes';
                if (dateFrom && dateTo) {
                    title += ` (${dateFrom} al ${dateTo})`;
                }

                let data = [];
                const headers = ['Serie-Número', 'Tipo', 'Cliente', 'Fecha', 'Total'];
                data.push(headers);

                rows.forEach(row => {
                    const cols = row.querySelectorAll('td');
                    const rowData = [
                        cols[0].textContent.trim(),
                        cols[1].textContent.trim(),
                        cols[2].textContent.trim(),
                        cols[3].textContent.trim(),
                        cols[4].textContent.trim()
                    ];
                    data.push(rowData);
                });

                switch (format) {
                    case 'csv':
                        downloadCSV(data, title);
                        break;
                    case 'txt':
                        downloadTXT(data, title);
                        break;
                    case 'pdf':
                        downloadPDF(data, title);
                        break;
                }
            }

            function downloadCSV(data, title) {
                // Agregar título y fecha como primeras filas
                const csvData = [
                    [title],
                    [`Fecha de generación: ${new Date().toLocaleDateString()}`],
                    [''], // Línea en blanco
                    ...data
                ];
                const csv = csvData.map(row => row.join(',')).join('\n');
                downloadFile(csv, 'comprobantes.csv', 'text/csv');
            }

            function downloadTXT(data, title) {
                // Agregar título y fecha como primeras líneas
                const txtData = [
                    title,
                    `Fecha de generación: ${new Date().toLocaleDateString()}`,
                    '', // Línea en blanco
                    ...data.map(row => row.join('\t'))
                ];
                const txt = txtData.join('\n');
                downloadFile(txt, 'comprobantes.txt', 'text/plain');
            }

            function downloadPDF(data, title) {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Configurar título y metadatos
                doc.setProperties({
                    title: title,
                    creator: 'Sistema de Restaurante'
                });

                // Título del documento
                doc.setFontSize(18);
                doc.text(title, 14, 20);

                // Fecha de generación
                doc.setFontSize(11);
                doc.text(`Fecha de generación: ${new Date().toLocaleDateString()}`, 14, 30);

                // Generar tabla
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
                    },
                    // Configurar ancho de columnas
                    columnStyles: {
                        0: {
                            cellWidth: 30
                        }, // Serie-Número
                        1: {
                            cellWidth: 25
                        }, // Tipo
                        2: {
                            cellWidth: 50
                        }, // Cliente
                        3: {
                            cellWidth: 35
                        }, // Fecha
                        4: {
                            cellWidth: 30
                        } // Total
                    }
                });

                doc.save('comprobantes.pdf');
            }

            function downloadFile(content, fileName, mimeType) {
                const blob = new Blob([content], {
                    type: mimeType
                });
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

                if (!dateFrom.value || !dateTo.value) {
                    rows.forEach(row => row.style.display = '');
                    return;
                }

                const from = new Date(dateFrom.value);
                const to = new Date(dateTo.value);
                from.setHours(0, 0, 0, 0);
                to.setHours(23, 59, 59, 999);

                rows.forEach(row => {
                    const dateStr = row.querySelector('td:nth-child(4)').textContent;
                    const [datePart, timePart] = dateStr.split(' ');
                    const [day, month, year] = datePart.split('/');
                    const [hours, minutes] = timePart.split(':');

                    const rowDate = new Date(year, month - 1, day, hours, minutes);
                    row.style.display = (rowDate >= from && rowDate <= to) ? '' : 'none';
                });
            }

            dateFrom.addEventListener('change', filterByDate);
            dateTo.addEventListener('change', filterByDate);

            // Agregar manejador de F1
            document.addEventListener('keydown', function(event) {
                if (event.key === 'F1') {
                    event.preventDefault();
                    window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
                }
            });
        });

        // Agregar estas funciones al JavaScript existente
        function showInvoiceModal(invoiceId) {
            fetch(`/invoices/${invoiceId}/details`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalContent').innerHTML = html;
                    document.getElementById('invoiceModal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('invoiceModal').classList.add('hidden');
        }

        // Cerrar modal al hacer clic fuera de él
        document.getElementById('invoiceModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@stop
