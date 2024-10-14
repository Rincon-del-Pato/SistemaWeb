@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    {{-- <h1 class="mb-4">Lista de Empleados</h1> --}}
@stop

@section('content')

    <div class="container-fluid">
        <h1 class="mb-3">Empleados</h1>

        <form action="{{ route('employees.index') }}" method="GET">
            <div class="mb-3 row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="mb-2 col-md-4 mb-md-0">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar empleados..."
                                    value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Botón para eliminar el filtro de búsqueda -->
                        @if (request('search'))
                            <div class="mb-2 col-md-4 mb-md-0">
                                <a href="{{ route('employees.index') }}" class="btn btn-outline-danger">
                                    Eliminar búsqueda
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Empleado
                    </a>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="p-0 card-body table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Nº</th>
                            <th scope="col">Empleado</th>
                            {{-- <th scope="col">Email</th> --}}
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
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $employee->user()->first()->profile_photo_path) }}"
                                            class="mr-3 rounded-circle" width="40" height="40"
                                            alt="{{ $employee->user()->first()->name }} ">
                                        <div>
                                            <p class="mb-0 font-weight-bold">
                                                {{ $employee->user()->first()->name }} {{ $employee->lastname }}
                                            </p>
                                            <p class="mb-0 text-muted">
                                                {{ $employee->user()->first()->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $employee->dni }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    {{-- <span class="badge badge-success"> --}}
                                    {{ $employee->user->getRoleNames()->implode(', ') }}
                                    {{-- </span> --}}
                                </td>
                                {{-- <td>
                            <span class="badge badge-{{ $employee->status == 'Online' ? 'success' : 'danger' }}">
                                {{ $employee->status }}
                            </span>
                        </td> --}}
                                <td class="text-center">
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('employees.show', $employee) }}"
                                            class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-between align-items-center">
            <!-- Mostrando registros -->
            <div>
                Mostrando {{ $employees->firstItem() }} a {{ $employees->lastItem() }} de {{ $employees->total() }}
                productos
            </div>

            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="mb-0 pagination">
                    <!-- Botón 'Anterior' -->
                    <li class="page-item {{ $employees->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $employees->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Anterior</span>
                        </a>
                    </li>

                    <!-- Números de página -->
                    @for ($i = 1; $i <= $employees->lastPage(); $i++)
                        <li class="page-item {{ $i == $employees->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $employees->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Botón 'Siguiente' -->
                    <li class="page-item {{ $employees->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $employees->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">Siguiente &raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
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
