@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Lista de Categorías</h1>
@stop

@section('content')

    <a href="categories/create" class="mb-3 btn btn-primary"><i class="fas fa-plus"></i> CREAR</a>

    <table id="categorias" class="table mt-4 shadow-lg table-striped table-bordered" style="width:100%">
        <thead class="text-white bg-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $categorie)
                <tr>
                    <td>{{ $categorie->id }}</td>
                    <td>{{ $categorie->name }}</td>
                    <td>{{ $categorie->description }}</td>
                    <td class="text-center">
                        <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                <i class="fas fa-trash"></i> Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
