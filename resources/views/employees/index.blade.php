@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1 class="mb-4">Lista de Empleados</h1>
@stop

@section('content')

    <a href="{{ route('employees.create') }}" class="mb-3 btn btn-primary">
        <i class="fas fa-plus"></i> CREAR NUEVO EMPLEADO
    </a>

    <div class="table-responsive">
        <table id="empleados" class="table shadow-sm table-hover table-striped table-bordered" style="width:100%">
            <thead class="text-white bg-primary">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Email</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Rol</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class="text-center">{{ $employee->id }}</td>
                        <td>{{ $employee->lastname }}  {{ $employee->user()->first()->name }}</td>
                        <td>{{ $employee->user()->first()->email }}</td>
                        <td>{{ $employee->dni }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            <span class="badge bg-info text-dark me-1"
                                    style="font-size: 1rem">{{ $employee->user->getRoleNames()->implode(', ') }}</span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
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
    <script>
        console.log('Hi!');
    </script>
@stop
