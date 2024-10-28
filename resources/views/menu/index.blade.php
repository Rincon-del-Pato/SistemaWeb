@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    {{-- <h1 class="mb-4">Lista de Productos</h1> --}}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="mt-4 col-md-12">
                <div class="card card-default">
                    <!-- Cabecera de la tarjeta -->
                    <div class="card-header">
                        <div class="row w-100 align-items-center">
                            <div class="col">
                                <h2 class="mb-0">Lista de Productos</h2>
                            </div>
                            <div class="text-right col">
                                <a href="{{ route('menus.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Agregar productos al carta
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body">
                        <div class="mb-4 border-bottom">
                            <ul class="border-0 nav nav-tabs custom-tabs" id="productTabs" role="tablist">
                                @foreach ($categories as $index => $category)
                                    <li class="nav-item">
                                        <button class="nav-link {{ $index === 0 ? 'active' : '' }} px-4"
                                            id="category-{{ $category->id }}-tab" data-toggle="tab"
                                            data-target="#category-{{ $category->id }}" type="button" role="tab">
                                            {{ $category->name }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="pt-4 tab-content" id="productTabsContent">
                            @foreach ($categories as $index => $category)
                                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                    id="category-{{ $category->id }}" role="tabpanel">

                                    <h3 class="mb-4">{{ $category->name }}</h3>

                                    <div class="row g-4">
                                        @foreach ($products->where('category_id', $category->id) as $product)
                                            <div class="mb-4 col-md-6">
                                                <div
                                                    class="p-3 bg-white rounded shadow-sm d-flex align-items-center {{ $product->status == 'Oculto' ? 'product-hidden' : '' }}">
                                                    <img src="{{ asset('storage/' . $product->image_producto) }}"
                                                        alt="{{ $product->name }}" class="rounded img-fluid product-image"
                                                        style="width: 100px; height: 100px; object-fit: cover; margin-right: 20px;">

                                                    <div class="flex-grow-1">
                                                        <div class="mb-2 d-flex justify-content-between align-items-start">
                                                            <h5 class="mb-0">{{ $product->name }}</h5>
                                                            <span
                                                                class="text-muted fw-bold">${{ number_format($product->price, 2) }}</span>
                                                        </div>
                                                        <p class="mb-2 text-muted small">{{ $product->description }}</p>
                                                        <div class="d-flex align-items-center">
                                                            @if ($product->status != 'Oculto')
                                                                <span
                                                                    class="badge bg-{{ $product->status == 'Disponible' ? 'success' : 'danger' }}">
                                                                    {{ $product->status }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($products->where('category_id', $category->id)->isEmpty())
                                        <div class="py-5 text-center text-muted">
                                            <p class="mb-0">No hay productos disponibles en esta categoría</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Estilos existentes */
        .custom-tabs .nav-link {
            color: #6c757d;
            border: none;
            position: relative;
            padding: 1rem 1.5rem;
            margin-right: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .custom-tabs .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .custom-tabs .nav-link:hover:not(.active) {
            color: #495057;
        }

        .custom-tabs .nav-link:hover:not(.active)::after {
            background-color: #dee2e6;
        }

        .custom-tabs .nav-link.active {
            color: #0d6efd;
            background-color: transparent;
            font-weight: 600;
        }

        .custom-tabs .nav-link.active::after {
            background-color: #0d6efd;
        }

        .card-body {
            padding: 1.5rem;
        }

        .shadow-sm {
            transition: all 0.3s ease;
        }

        .shadow-sm:hover {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.15) !important;
        }

        /* Nuevos estilos para productos ocultos */
        .product-hidden {
            background-color: #f8f9fa !important;
            opacity: 0.7;
        }

        .product-hidden .product-image {
            filter: grayscale(100%);
        }

        .product-hidden h5,
        .product-hidden p,
        .product-hidden span {
            color: #6c757d !important;
        }
    </style>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
