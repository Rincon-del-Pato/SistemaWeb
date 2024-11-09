@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <h1 class="text-2xl font-semibold">Lista de Mesas</h1>
@stop

@section('content')
    <div class="px-4 py-6">
        <a href="tables/create" class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
            <i class="fas fa-plus mr-2"></i> CREAR
        </a>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
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
                                    <span class="text-sm font-medium text-gray-900">{{ $table->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-gray-400 mr-2"></i>
                                    <span class="text-sm text-gray-900">{{ $table->capacity }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="flex items-center">
                                    <i class="fas fa-circle mr-2 text-{{ $table->status->value === 'Disponible' ? 'green' : ($table->status->value === 'Ocupado' ? 'red' : 'yellow') }}-500"></i>
                                    <span class="text-sm text-gray-900">{{ $table->status->value }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('tables.edit', $table->id) }}"
                                       class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                    <form action="{{ route('tables.destroy', $table->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta mesa?');">
                                            <i class="fas fa-trash mr-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-between items-center">
            <p class="text-sm text-gray-600">
                Mostrando {{ $tables->firstItem() }} a {{ $tables->lastItem() }} de {{ $tables->total() }} mesas
            </p>

            <div class="flex justify-end">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    <a href="{{ $tables->previousPageUrl() }}"
                       class="{{ $tables->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }} relative inline-flex items-center px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Anterior
                    </a>

                    @for ($i = 1; $i <= $tables->lastPage(); $i++)
                        <a href="{{ $tables->url($i) }}"
                           class="{{ $i == $tables->currentPage() ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50' }} relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            {{ $i }}
                        </a>
                    @endfor

                    <a href="{{ $tables->nextPageUrl() }}"
                       class="{{ !$tables->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }} relative inline-flex items-center px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Siguiente
                    </a>
                </nav>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
