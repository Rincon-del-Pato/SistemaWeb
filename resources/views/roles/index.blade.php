@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    {{-- <h1 class="mb-4">Lista de Roles</h1> --}}
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="mb-3">Roles</h1>

        <form action="{{ route('roles.index') }}" method="GET">
            <div class="mb-3 row">
                <div class="col-md-8">
                    {{-- <div class="row">
                        <div class="mb-2 col-md-4 mb-md-0">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar productos..."
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
                                <a href="{{ route('roles.index') }}" class="btn btn-outline-danger">
                                    Eliminar búsqueda
                                </a>
                            </div>
                        @endif
                    </div> --}}
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Roles
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
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este rol?')">
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
                Mostrando {{ $roles->firstItem() }} a {{ $roles->lastItem() }} de {{ $roles->total() }}
                productos
            </div>

            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="mb-0 pagination">
                    <!-- Botón 'Anterior' -->
                    <li class="page-item {{ $roles->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $roles->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Anterior</span>
                        </a>
                    </li>

                    <!-- Números de página -->
                    @for ($i = 1; $i <= $roles->lastPage(); $i++)
                        <li class="page-item {{ $i == $roles->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $roles->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Botón 'Siguiente' -->
                    <li class="page-item {{ $roles->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $roles->nextPageUrl() }}" aria-label="Next">
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
