@extends('adminlte::page')

@section('title', 'Unidades')

@section('content')
<div class="p-4 container-fluid">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Unidades de Medida</h1>
                <p class="mt-1 text-sm text-gray-600">Administra las unidades de medida para ingredientes</p>
            </div>
            <a href="{{ route('units.create') }}" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
                Crear Unidad
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3">Abreviación</th>
                            <th scope="col" class="px-6 py-3">Descripción</th>
                            <th scope="col" class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">{{ $unit->id }}</td>
                            <td class="px-6 py-4">{{ $unit->unit_name }}</td>
                            <td class="px-6 py-4">{{ $unit->abbreviation }}</td>
                            <td class="px-6 py-4">{{ $unit->description }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('units.edit', $unit->id) }}" 
                                       class="px-3 py-1.5 text-sm text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                        Editar
                                    </a>
                                    <form action="{{ route('units.destroy', $unit->id) }}" method="POST" 
                                          class="inline-block" onsubmit="return confirm('¿Estás seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1.5 text-sm text-white bg-red-700 rounded-lg hover:bg-red-800">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
    <script> console.log('Hi!'); </script>

    document.addEventListener('keydown', function(event) {
        if (event.key === 'F1') {
            event.preventDefault();
            window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
        }
    });
@stop
