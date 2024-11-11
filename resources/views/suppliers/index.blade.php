@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
@stop

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Lista de Proveedores</h1>
        <a href="{{ route('suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Proveedor</a>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Contacto</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Dirección</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td class="border px-4 py-2">{{ $supplier->id }}</td>
                        <td class="border px-4 py-2">{{ $supplier->name }}</td>
                        <td class="border px-4 py-2">{{ $supplier->contact_name }}</td>
                        <td class="border px-4 py-2">{{ $supplier->phone }}</td>
                        <td class="border px-4 py-2">{{ $supplier->email }}</td>
                        <td class="border px-4 py-2">{{ $supplier->address }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
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
