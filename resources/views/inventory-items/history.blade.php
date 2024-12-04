@extends('adminlte::page')

@section('title', 'Historial de Inventario')

@section('content')
<div class="container-fluid">
    <div class="p-4">
        <div class="mb-4 bg-white rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">Historial de {{ $item->name }}</h1>
                <p class="mt-1 text-sm text-gray-600">Registro de cambios en el inventario</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Fecha</th>
                            <th scope="col" class="px-6 py-3">Tipo de Cambio</th>
                            <th scope="col" class="px-6 py-3">Cantidad</th>
                            <th scope="col" class="px-6 py-3">Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $log->change_date }}</td>
                                <td class="px-6 py-4">
                                    @switch($log->change_type->value)
                                        @case('Creado')
                                            <span class="text-blue-600">Creado</span>
                                            @break
                                        @case('Adición')
                                            <span class="text-green-600">Adición</span>
                                            @break
                                        @case('Disminuir')
                                            <span class="text-red-600">Disminuir</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4">{{ $log->quantity_change }}</td>
                                <td class="px-6 py-4">{{ $log->notes }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No hay registros de cambios
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>

        <div class="mt-4">
            <a href="{{ route('inventory.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="mr-2 fas fa-arrow-left"></i>Volver al inventario
            </a>
        </div>
    </div>
</div>
@stop