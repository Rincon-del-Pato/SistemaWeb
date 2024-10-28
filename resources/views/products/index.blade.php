@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    {{-- <h1 class="mb-4">Lista de Productos</h1> --}}
@stop

@section('content')
    <div class="container-fluid">
        <h1 class="mb-3">Productos</h1>

        <form action="{{ route('products.index') }}" method="GET">
            <div class="mb-3 row">
                <div class="col-md-8">
                    <div class="row">
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
                                <a href="{{ route('products.index') }}" class="btn btn-outline-danger">
                                    Eliminar búsqueda
                                </a>
                            </div>
                        @endif
                        {{-- <div class="col-md-4">
                            <select name="category" class="form-control" onchange="this.form.submit()">
                                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Todas las
                                    categorías</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </a>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="p-0 table-responsive">
                <!-- class="p-0 card-body table-responsive" -->
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Nº</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Tamaño</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($product->image_producto)
                                            <img src="{{ asset('storage/' . $product->image_producto) }}"
                                                alt="{{ $product->name }}" class="mr-2 img-thumbnail" style="width: 50px;">
                                        @endif
                                        {{ $product->name }}
                                    </div>
                                </td>
                                <td>{{ $product->description }}</td>
                                @if ($product->sizes->isNotEmpty())
                                    @foreach ($product->sizes as $size)
                                        <td>{{ $size->price, 2 }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $size->status == 'Disponible' ? 'success' : 'danger' }}">
                                                {{ $size->status }}
                                            </span>
                                        </td>
                                    @endforeach
                                @else
                                @endif

                                <td>S/.{{ number_format($product->price, 2) }}</td>
                                <td>
                                    <span
                                        class="badge badge-{{ $product->status == 'Disponible' ? 'success' : 'danger' }}">
                                        {{ $product->status }}
                                    </span>
                                </td>

                                <td>{{ $product->category()->first()->name }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}

                        @foreach ($products as $product)
                            @if ($product->sizes->count() > 1)
                                @foreach ($product->sizes as $index => $size)
                                    <tr>
                                        @if ($index === 0)
                                            <td rowspan="{{ $product->sizes->count() }}" class="text-center align-middle">
                                                {{ $product->id }}</td>
                                            <td rowspan="{{ $product->sizes->count() }}" class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    @if ($product->image_producto)
                                                        <img src="{{ asset('storage/' . $product->image_producto) }}"
                                                            alt="{{ $product->name }}" class="mr-2 img-thumbnail"
                                                            style="width: 50px;">
                                                    @endif
                                                    {{ $product->name }}
                                                </div>
                                            </td>
                                            <td rowspan="{{ $product->sizes->count() }}" class="align-middle">
                                                {{ $product->description }}</td>
                                        @endif

                                        <td class="align-middle ">{{ $size->type }}</td>
                                        <td class="text-center align-middle">S/.{{ number_format($size->price, 2) }}</td>
                                        <td class="text-center align-middle">
                                            <span
                                                class="badge badge-{{ $size->status == 'Disponible' ? 'success' : 'danger' }}">
                                                {{ $size->status }}
                                            </span>
                                        </td>

                                        @if ($index === 0)
                                            <td rowspan="{{ $product->sizes->count() }}" class="align-middle">
                                                {{ $product->category->name ?? 'Sin categoría' }}</td>
                                            <td rowspan="{{ $product->sizes->count() }}" class="align-middle">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('products.edit', $product) }}"
                                                        class="mr-1 btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center align-middle">{{ $product->id }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            @if ($product->image_producto)
                                                <img src="{{ asset('storage/' . $product->image_producto) }}"
                                                    alt="{{ $product->name }}" class="mr-2 img-thumbnail"
                                                    style="width: 50px;">
                                            @endif
                                            {{ $product->name }}
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $product->description }}</td>
                                    <td class="align-middle ">{{ $product->sizes->first()->type }}</td>
                                    <td class="text-center align-middle">
                                        S/.{{ number_format($product->sizes->first()->price, 2) }}</td>
                                    <td class="text-center align-middle">
                                        <span
                                            class="badge badge-{{ $product->sizes->first()->status == 'Disponible' ? 'success' : 'danger' }}">
                                            {{ $product->sizes->first()->status }}
                                        </span>
                                    </td>
                                    <td class="align-middle">{{ $product->category->name ?? 'Sin categoría' }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="mr-1 btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Paginación -->
        <div class="d-flex justify-content-between align-items-center">
            <!-- Mostrando registros -->
            <div>
                Mostrando {{ $products->firstItem() }} a {{ $products->lastItem() }} de {{ $products->total() }}
                productos
            </div>

            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="mb-0 pagination">
                    <!-- Botón 'Anterior' -->
                    <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Anterior</span>
                        </a>
                    </li>

                    <!-- Números de página -->
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Botón 'Siguiente' -->
                    <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
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
