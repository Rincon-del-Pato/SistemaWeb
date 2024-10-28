@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    {{-- <h1 class="mb-4">Lista de Productos</h1> --}}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card card-default">
                    <!-- Cabecera de la tarjeta con texto a la izquierda y botón a la derecha -->
                    <div class="card-header">
                        <div class="row w-100 align-items-center">
                            <div class="col">
                                <h2 class="mb-0">Lista de Productos</h2>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('menus.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Agregar Producto
                                </a>
                            </div>
                        </div>
                    </div>


                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
                            @foreach ($categories as $index => $category)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                        id="category-{{ $category->id }}-tab" data-toggle="tab"
                                        data-target="#category-{{ $category->id }}" type="button" role="tab"
                                        aria-controls="category-{{ $category->id }}"
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                        {{ $category->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content mt-3" id="productTabsContent">
                            @foreach ($categories as $index => $category)
                                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                    id="category-{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="category-{{ $category->id }}-tab">
                                    <h3>{{ $category->name }}</h3>
                                    <ul class="list-group">
                                        @foreach ($products->where('category_id', $category->id) as $product)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5>{{ $product->name }}</h5>
                                                    <p>{{ $product->description }}</p>
                                                    <small>Precio: ${{ number_format($product->price, 2) }}</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-{{ $product->status == 'Disponible' ? 'success' : ($product->status == 'Agotado' ? 'danger' : 'secondary') }}">
                                                        {{ $product->status }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
