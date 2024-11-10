@extends('adminlte::page')

@section('title', 'Tamaño')

@section('content_header')
@stop

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Lista de Tamaños en el Menú</h1>
        <a href="{{ route('menu-items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Tamaño</a>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <td class="border px-4 py-2">{{ $size->id }}</td>
                        <td class="border px-4 py-2">{{ $size->size_name }}</td>
                        <td class="border px-4 py-2">{{ $size->description }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('menu-items.edit', $size->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                            <form action="{{ route('menu-items.destroy', $size->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
