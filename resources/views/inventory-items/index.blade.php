@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
@stop

@section('content')
<div class="container">
    <h1 class="my-4">Inventario de Artículos</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón para agregar un nuevo artículo al inventario -->
    <div class="mb-4">
        <a href="{{ route('inventory.create') }}" class="btn btn-primary">Agregar Artículo al Inventario</a>
    </div>

    <!-- Tabla de artículos del inventario -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Nivel de Reorden</th>
                <th>Unidad</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventoryItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ ucfirst($item->item_type->value) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->reorder_level }}</td>
                    <td>{{ $item->unit->unit_name }}</td>
                    <td>{{ $item->supplier ? $item->supplier->name : 'Ninguno' }}</td>
                    <td>
                        <!-- Botones de acciones para editar o eliminar -->
                        <a href="{{ route('inventory.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este artículo?')">Eliminar</button>
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
