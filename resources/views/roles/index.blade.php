@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1 class="mb-4">Lista de Roles</h1>
@stop

@section('content')

    <a href="{{ route('roles.create') }}" class="mb-3 btn btn-primary">
        <i class="fas fa-plus"></i> CREAR NUEVO ROL
    </a>

    <div class="table-responsive">
        <table id="roles" class="table shadow-sm table-hover table-striped table-bordered" style="width:100%">
            <thead class="text-white bg-primary">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Rol</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $rol)
                    <tr>
                        <td class="text-center">{{ $rol->id }}</td>
                        <td>{{ $rol->description }}</td>
                        <td class="text-center">
                            <form action="{{ route('roles.destroy', $rol) }}" method="POST">
                                <a href="{{ route('roles.edit', $rol) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                {{-- <a href="{{ route('roles.show', $rol) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-eye"></i> Ver
                                </a> --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este rol?')">
                                    <i class="fas fa-trash"></i> Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
