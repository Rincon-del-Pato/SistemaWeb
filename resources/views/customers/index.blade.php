@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
@stop

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold">Lista de Clientes</h1>
    <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Cliente</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td class="border px-4 py-2">{{ $customer->id }}</td>
                <td class="border px-4 py-2">{{ $customer->name }}</td>
                <td class="border px-4 py-2">{{ $customer->email }}</td>
                <td class="border px-4 py-2">{{ $customer->phone }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block">
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
