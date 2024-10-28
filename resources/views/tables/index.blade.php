@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <h1>Lista de Mesas</h1>
@stop

@section('content')

    <a href="tables/create" class="mb-3 btn btn-primary">CREAR</a>

    {{-- <table id="empleados" class="table mt-4 shadow-lg table-striped table-bordered" style="width:100%">
        <thead class="text-white bg-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($roles as $rol)
                <tr>
                    <td>{{$rol->id}}</td>
                    <td>{{$rol->name}}  </td>


                    <td>
                        <form action="{{route('roles.destroy',$rol)}}" method="POST">
                            <a href="{{route('roles.edit',$rol)}}" class="btn btn-info">Editar</a>
                            <a href="{{route('roles.show',$rol)}}" class="btn btn-info">Ver</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    <div class="row">
        @foreach ($tables as $table)
            <div class="mb-4 col-md-3">
                <div
                    class="shadow-md card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">
                                    <i class="fas fa-table"></i> {{ $table->name }}
                                </h5>
                            </div>
                            <div class="text-right col-6">
                                <p class="card-text">
                                    <i class="fas fa-users"></i> {{ $table->capacity }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="card-text">
                                <i class="fas fa-circle"
                                    style="
                                    color: {{ $table->status->value === 'Disponible' ? 'green' : ($table->status->value === 'Ocupado' ? 'red' : 'orange') }};">
                                </i>
                                {{ $table->status->value }}
                            </p>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('tables.destroy', $table->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta mesa?');">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-between align-items-center">
        <!-- Mostrando registros -->
        <div>
            Mostrando {{ $tables->firstItem() }} a {{ $tables->lastItem() }} de {{ $tables->total() }}
            productos
        </div>

        <!-- Paginación -->
        <nav aria-label="Page navigation">
            <ul class="mb-0 pagination">
                <!-- Botón 'Anterior' -->
                <li class="page-item {{ $tables->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tables->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Anterior</span>
                    </a>
                </li>

                <!-- Números de página -->
                @for ($i = 1; $i <= $tables->lastPage(); $i++)
                    <li class="page-item {{ $i == $tables->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $tables->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <!-- Botón 'Siguiente' -->
                <li class="page-item {{ $tables->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $tables->nextPageUrl() }}" aria-label="Next">
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
