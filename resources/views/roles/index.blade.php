@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="pt-4 mb-4 text-2xl font-semibold">Roles</h1>

        <!-- Barra de búsqueda y botón separados de la tabla -->
        <div class="flex items-center justify-between mb-4">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block pt-2 text-sm bg-white border border-gray-300 rounded-lg ps-10 w-80 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Buscar roles...">
            </div>
            <a href="{{ route('roles.create') }}"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300">
                <i class="mr-2 fas fa-plus"></i>Agregar Roles
            </a>
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
                        <tr class="border-b hover:bg-gray-50">
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
                                    <button type="submit"
                                        class="text-red-600 text-l hover:text-red-900"
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
        });
    </script>
@stop
