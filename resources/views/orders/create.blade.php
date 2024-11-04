@extends('adminlte::page')

@section('title', 'Crear Orden')

@section('content_header')
    <h1> <i class="fas fa-concierge-bell"></i> Nueva Orden</h1>
@stop

@section('content')
    <div class="container-fluid mt-4">
        <ul class="nav nav-tabs mb-4" id="categoryTabs" role="tablist">
            @foreach ($categories as $index => $category)
                <li class="nav-item">
                    <button class="nav-link {{ $index === 0 ? 'active' : '' }} px-3" id="category-{{ $category->id }}-tab"
                        data-toggle="tab" data-target="#category-{{ $category->id }}" type="button" role="tab">
                        {{ $category->name }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Carta</h2>
                    </div>
                    <div class="card-body">
                        <!-- Contenido de las tabs -->
                        <div class="tab-content" id="categoryTabsContent">
                            @foreach ($categories as $category)
                                <div class="tab-pane {{ $loop->first ? 'show active' : '' }}"
                                    id="category-{{ $category->id }}" role="tabpanel">
                                    <div class="row">
                                        @if (isset($products[$category->id]))
                                            @foreach ($products[$category->id] as $product)
                                                <div class="mb-3 col-md-4">
                                                    <div class="card product-card">
                                                        <div class="card-body text-center">
                                                            <img src="{{ $product->image_producto ? asset('storage/' . $product->image_producto) : asset('imagen/plato-vacio.png') }}"
                                                                class="product-image mb-3" alt="{{ $product->name }}">
                                                            <h5 class="card-title mb-3">{{ $product->name }}</h5>

                                                            @if ($product->sizes->count() == 1)
                                                                <div class="product-price single-price mb-2">
                                                                    <strong class="d-block mb-2">S/.
                                                                        {{ $product->sizes->first()->price }}</strong>
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-block btn-add-product"
                                                                        data-id="{{ $product->id }}"
                                                                        data-name="{{ $product->name }}"
                                                                        data-price="{{ $product->sizes->first()->price }}">
                                                                        <i class="fas fa-cart-plus"></i> Agregar
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="product-price multiple-prices">
                                                                    @foreach ($product->sizes as $size)
                                                                        <div class="size-option mb-2">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <span>{{ $size->type }}</span>
                                                                                <div>
                                                                                    <span class="mr-2">S/.
                                                                                        {{ $size->price }}</span>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-sm btn-add-product"
                                                                                        data-id="{{ $product->id }}"
                                                                                        data-name="{{ $product->name }}"
                                                                                        data-size="{{ $size->type }}"
                                                                                        data-price="{{ $size->price }}">
                                                                                        <i class="fas fa-cart-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">{{ $table->name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 pb-2 border-bottom">
                            <div class="col-6">
                                <div class="d-flex align-items-center h-100">
                                    <i class="fas fa-user-circle fa-2x mr-2 text-primary"></i>
                                    <div>
                                        <small class="text-muted d-block">Empleado</small>
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <span class="d-block text-muted">{{ $employees->lastname ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center h-100">
                                    <i class="fas fa-users fa-2x mr-2 text-primary"></i>
                                    <div>
                                        <small class="text-muted d-block">Personas</small>
                                        <strong class="h4 mb-0">{{ $peopleCount }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-items-container">
                            <table class="table table-borderless">
                                <thead id="orderTableHeader" style="display: none;">
                                    <tr>
                                        <th>Cant</th>
                                        <th>Plato</th>
                                        <th>P. Unit</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="orderItems">
                                    <!-- Aquí se mostrarán los items dinámicamente -->
                                </tbody>
                            </table>
                        </div>

                        <div class="border-top pt-3 mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Total:</h5>
                                <h4 class="mb-0 text-primary">S/. <span id="orderTotal">0.00</span></h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="mt-3 btn btn-success btn-lg" id="confirmOrder">
                                <i class="fas fa-check mr-2"></i>Confirmar
                            </button>
                            <a href=" {{ route('order.index') }}" class="mt-3 btn btn-danger btn-lg">
                                <i class="fas fa-ban"></i> <span class="ms-1">Cancelar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para selección de tamaños -->
    <div class="modal fade" id="sizeSelectionModal" tabindex="-1" role="dialog" aria-labelledby="sizeSelectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sizeSelectionModalLabel">Seleccionar Tamaño</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 id="modalProductName" class="mb-3"></h6>
                    <div id="sizeOptions" class="list-group">
                        <!-- Las opciones de tamaño se insertarán dinámicamente -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .nav-tabs {
            border-bottom: none;
        }

        #categoryTabs .nav-item {
            margin-bottom: 0;
        }

        #categoryTabs .nav-link {
            transition: all 0.3s;
            border-radius: 8px !important;
            margin: 0 3px;
            font-size: 0.9rem;
            padding: 0.5rem 1.5rem;
            border: 1px solid #ddd !important;
            background: white;
            box-shadow: none !important;
            outline: none !important;
        }

        #categoryTabs .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
        }

        #categoryTabs .nav-link.active {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2) !important;
        }

        #categoryTabs .nav-link:not(.active) {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .product-card {
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .product-card .card-body {
            background-color: #ffffff !important;
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 1rem;
        }

        .product-image {
            max-height: 150px;
            height: 150px;
            width: 100%;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-top: auto;
            /* Empuja el precio al fondo del card */
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Asegurar que los cards tengan el mismo tamaño */
        .mb-3.col-md-4 {
            display: flex;
        }

        .card.product-card {
            width: 100%;
            margin-bottom: 1rem;
        }

        /* Fondo beige para el panel principal */
        .card>.card-body {
            background-color: #fff8f0;
        }

        .list-group-item {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-header .close {
            color: white;
        }

        .product-price.multiple-prices {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .size-types {
            display: flex;
            justify-content: space-around;
            font-weight: bold;
            color: #2c3e50;
        }

        .price-values {
            display: flex;
            justify-content: space-around;
            color: #2c3e50;
        }

        .size-type,
        .price-value {
            padding: 0.1rem 0.5rem;
            font-size: 1.1rem;
        }

        .single-price {
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
        }

        .order-items-container {
            max-height: calc(100vh - 400px);
            overflow-y: auto;
            margin: 0 -1rem;
            padding: 0 1rem;
        }

        .text-primary {
            color: #007bff !important;
        }

        .card-header.bg-primary {
            background-color: #007bff !important;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderManager = {
                items: [],

                init: function() {
                    this.bindEvents();
                },

                bindEvents: function() {
                    // Agregar productos
                    document.querySelectorAll('.btn-add-product').forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const btn = e.currentTarget;
                            this.addProduct({
                                id: btn.dataset.id,
                                name: btn.dataset.name,
                                size: btn.dataset.size || '',
                                price: parseFloat(btn.dataset.price)
                            });
                        });
                    });

                    // Confirmar orden
                    document.getElementById('confirmOrder').addEventListener('click', () => {
                        this.confirmOrder();
                    });

                    // Delegación de eventos para botones dinámicos
                    document.getElementById('orderItems').addEventListener('click', (e) => {
                        const target = e.target;

                        if (target.classList.contains('btn-quantity')) {
                            const index = parseInt(target.dataset.index);
                            const change = parseInt(target.dataset.change);
                            this.updateQuantity(index, change);
                        }

                        if (target.classList.contains('btn-remove') || target.closest(
                                '.btn-remove')) {
                            const index = parseInt(target.dataset.index || target.closest(
                                '.btn-remove').dataset.index);
                            this.removeItem(index);
                        }
                    });
                },

                addProduct: function(product) {
                    const existing = this.items.find(item =>
                        item.id === product.id && item.size === product.size
                    );

                    if (existing) {
                        existing.quantity += 1;
                    } else {
                        this.items.push({
                            ...product,
                            quantity: 1
                        });
                    }

                    this.updateDisplay();
                },

                updateQuantity: function(index, change) {
                    const item = this.items[index];
                    const newQuantity = item.quantity + change;

                    if (newQuantity > 0) {
                        item.quantity = newQuantity;
                    } else {
                        this.items.splice(index, 1);
                    }

                    this.updateDisplay();
                },

                removeItem: function(index) {
                    this.items.splice(index, 1);
                    this.updateDisplay();
                },

                updateDisplay: function() {
                    const container = document.getElementById('orderItems');
                    const header = document.getElementById('orderTableHeader');
                    let total = 0;

                    if (this.items.length > 0) {
                        header.style.display = 'table-header-group';
                    } else {
                        header.style.display = 'none';
                    }

                    container.innerHTML = this.items.map((item, index) => {
                        const subtotal = item.price * item.quantity;
                        total += subtotal;

                        return `
                        <tr>
                            <!-- Quantity Controls -->
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary btn-quantity" data-index="${index}" data-change="-1">-</button>
                                    <span class="btn btn-light disabled">${item.quantity}</span>
                                    <button class="btn btn-outline-secondary btn-quantity" data-index="${index}" data-change="1">+</button>
                                </div>
                            </td>

                            <!-- Product Info -->
                            <td>
                                <strong>${item.name}</strong>
                                ${item.size ? `<br><small class="text-muted">${item.size}</small>` : ''}
                            </td>

                            <!-- Unit Price -->
                            <td>S/.${item.price.toFixed(2)}</td>

                            <!-- Subtotal -->
                            <td>S/. ${subtotal.toFixed(2)}</td>

                            <!-- Actions -->
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-info" title="Observación">
                                        <i class="fas fa-comment"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-remove" data-index="${index}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        `;
                    }).join('');

                    document.getElementById('orderTotal').textContent = total.toFixed(2);
                },

                confirmOrder: function() {
                    if (this.items.length === 0) {
                        alert('Agregue al menos un producto a la orden');
                        return;
                    }

                    // Crear formulario dinámicamente
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/orders/table/{{ $table->id }}`;

                    // Token CSRF
                    const tokenField = document.createElement('input');
                    tokenField.type = 'hidden';
                    tokenField.name = '_token';
                    tokenField.value = '{{ csrf_token() }}';
                    form.appendChild(tokenField);

                    // Campos de la orden principal
                    const orderFields = [
                        ['table_id', {{ $table->id }}],
                        ['employee_id', {{ Auth::user()->employee->id ?? 1 }}],
                        ['total_amount', document.getElementById('orderTotal').textContent],
                        ['notes', '']
                    ];

                    orderFields.forEach(([name, value]) => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = name;
                        input.value = value;
                        form.appendChild(input);
                    });

                    // Campos de los items de la orden
                    this.items.forEach((item, index) => {
                        const itemFields = [
                            ['product_size_id', item.id],
                            ['quantity', item.quantity],
                            ['unit_price', item.price],
                            ['subtotal', (item.price * item.quantity).toFixed(2)],
                            ['special_instructions', '']
                        ];

                        itemFields.forEach(([name, value]) => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = `items[${index}][${name}]`;
                            input.value = value;
                            form.appendChild(input);
                        });
                    });

                    // Enviar formulario
                    document.body.appendChild(form);
                    form.submit();
                }
            };

            // Inicializar el administrador de órdenes
            orderManager.init();
        });
    </script>
@stop
