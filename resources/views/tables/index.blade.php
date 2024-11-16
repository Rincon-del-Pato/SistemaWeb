@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="text-2xl font-semibold pt-4 mb-4">Mesas</h1>

        <!-- Barra de búsqueda y botón -->
        <div class="flex justify-between items-center mb-4">
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
            <a href="{{ route('tables.create') }}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                <i class="fas fa-plus mr-2"></i>Agregar Mesa
            </a>
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
                        <tr class="hover:bg-gray-50">
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
                    const tableText = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const shouldShow = tableText.includes(searchTerm);
                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleRows++;
                });

                noResultsMessage.style.display = visibleRows === 0 ? 'block' : 'none';
            });
        });
    </script>
@stop
