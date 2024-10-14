@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    {{-- <h1 class="mb-4">Lista de Usuarios</h1> --}}
@stop

@section('content')

    <div class="container-fluid">
        <h1 class="mb-3">Usuarios</h1>

        <form action="{{ route('usuarios.index') }}" method="GET">
            <div class="mb-3 row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="mb-2 col-md-4 mb-md-0">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar usuarios..."
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
                                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-danger">
                                    Eliminar búsqueda
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Producto
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
                            <th scope="col">Usuario</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th scope="col" class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="text-center">{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @foreach ($usuario->roles as $rol)
                                        <span class="badge bg-info text-dark me-1"
                                            style="font-size: 1rem">{{ $rol->description }}</span>
                                    @endforeach
                                </td>

                                <td class="text-center">
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST">
                                        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
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
                Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }}
                productos
            </div>

            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="mb-0 pagination">
                    <!-- Botón 'Anterior' -->
                    <li class="page-item {{ $usuarios->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $usuarios->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Anterior</span>
                        </a>
                    </li>

                    <!-- Números de página -->
                    @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                        <li class="page-item {{ $i == $usuarios->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $usuarios->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Botón 'Siguiente' -->
                    <li class="page-item {{ $usuarios->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $usuarios->nextPageUrl() }}" aria-label="Next">
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
