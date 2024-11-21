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

                <a href="{{ route('inventory.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    <i class="mr-2 fas fa-plus"></i>Nuevo Artículo
                </a>
            </div>

            <!-- Artículos Preenvasados -->
            <div class="mb-6">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Productos para Venta</h2>
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
                                    <tr class="bg-white border-b hover:bg-gray-50">
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

            <!-- Ingredientes -->
            <div>
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Ingredientes</h2>
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
                                    <tr class="bg-white border-b hover:bg-gray-50">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('table-search');
            const tableRows = document.querySelectorAll('tbody tr');

            searchInput.addEventListener('keyup', function(e) {
                const searchTerm = e.target.value.toLowerCase();

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        });
    </script>
@stop
