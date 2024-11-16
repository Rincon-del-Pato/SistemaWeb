@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="text-2xl font-semibold pt-4 mb-4">Inventario de Artículos</h1>

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
                    placeholder="Buscar artículos...">
            </div>
            <a href="{{ route('inventory.create') }}"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                <i class="fas fa-plus mr-2"></i>Agregar Artículo
            </a>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-lg shadow">
            <table class="w-full text-base text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-6 py-4 border-b">Nombre</th>
                        <th class="px-6 py-4 border-b">Tipo</th>
                        <th class="px-6 py-4 border-b">Cantidad</th>
                        <th class="px-6 py-4 border-b">Nivel de Reorden</th>
                        <th class="px-6 py-4 border-b">Unidad</th>
                        <th class="px-6 py-4 border-b">Proveedor</th>
                        <th class="px-6 py-4 text-center border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventoryItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $item->name }}</td>
                            <td class="px-6 py-4">{{ ucfirst($item->item_type->value) }}</td>
                            <td class="px-6 py-4">{{ $item->quantity }}</td>
                            <td class="px-6 py-4">{{ $item->reorder_level }}</td>
                            <td class="px-6 py-4">{{ $item->unit->unit_name }}</td>
                            <td class="px-6 py-4">{{ $item->supplier ? $item->supplier->name : 'Ninguno' }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="inline-flex gap-2">
                                    <a href="{{ route('inventory.edit', $item->id) }}"
                                        class="text-yellow-400 hover:text-yellow-600">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('¿Estás seguro de eliminar este artículo?')">
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
                <span class="font-semibold text-gray-900">{{ $inventoryItems->firstItem() }}</span>
                a
                <span class="font-semibold text-gray-900">{{ $inventoryItems->lastItem() }}</span>
                de
                <span class="font-semibold text-gray-900">{{ $inventoryItems->total() }}</span>
                artículos
            </span>

            <nav aria-label="Page navigation">
                <ul class="inline-flex -space-x-px text-base">
                    <li>
                        <a href="{{ $inventoryItems->previousPageUrl() }}"
                           class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 {{ $inventoryItems->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Anterior
                        </a>
                    </li>

                    @for ($i = 1; $i <= $inventoryItems->lastPage(); $i++)
                        <li>
                            <a href="{{ $inventoryItems->url($i) }}"
                               class="flex items-center justify-center px-4 h-10 leading-tight {{ $inventoryItems->currentPage() == $i
                               ? 'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                               : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <li>
                        <a href="{{ $inventoryItems->nextPageUrl() }}"
                           class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 {{ !$inventoryItems->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
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
            noResultsMessage.textContent = 'No se encontraron artículos';
            noResultsMessage.style.display = 'none';

            const tableBody = document.querySelector('tbody');
            tableBody.parentNode.insertBefore(noResultsMessage, tableBody.nextSibling);

            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const tableRows = document.querySelectorAll('tbody tr');
                let visibleRows = 0;

                tableRows.forEach(row => {
                    const itemName = row.querySelector('td:first-child').textContent.toLowerCase();
                    const shouldShow = itemName.includes(searchTerm);
                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleRows++;
                });

                noResultsMessage.style.display = visibleRows === 0 ? 'block' : 'none';
            });
        });
    </script>
@stop
