@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    {{-- <h1>Lista de Categorías</h1> --}}
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="mb-3">Categorias</h1>

        <form action="{{ route('categories.index') }}" method="GET">
            <div class="mb-3 row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="mb-2 col-md-4 mb-md-0">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar categoria..."
                                    value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (request('search'))
                            <div class="mb-2 col-md-4 mb-md-0">
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">
                                    Eliminar búsqueda
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar categoria
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
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $categorie) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
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
                Mostrando {{ $categories->firstItem() }} a {{ $categories->lastItem() }} de {{ $categories->total() }}
                productos
            </div>

            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="mb-0 pagination">
                    <!-- Botón 'Anterior' -->
                    <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Anterior</span>
                        </a>
                    </li>

                    <!-- Números de página -->
                    @for ($i = 1; $i <= $categories->lastPage(); $i++)
                        <li class="page-item {{ $i == $categories->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Botón 'Siguiente' -->
                    <li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">Siguiente &raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
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
