@extends('adminlte::page')

@section('title', 'Platos')

@section('content_header')
@stop

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Lista de Tamaños y Precios de Platos</h1>
        <a href="{{ route('menu-item-sizes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Tamaño y
            Precio a un Plato</a>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Plato</th>
                    <th class="px-4 py-2">Tamaño</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menuItemSizes as $itemSize)
                    <tr>
                        <td class="border px-4 py-2">{{ $itemSize->id }}</td>
                        <td class="border px-4 py-2">{{ $itemSize->menuItem->name }}</td>
                        <td class="border px-4 py-2">{{ $itemSize->size->size_name }}</td>
                        <td class="border px-4 py-2">${{ number_format($itemSize->price, 2) }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('menu-item-sizes.edit', $itemSize->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                            <form action="{{ route('menu-item-sizes.destroy', $itemSize->id) }}" method="POST"
                                class="inline-block">
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
