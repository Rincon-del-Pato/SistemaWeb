@extends('adminlte::page')

@section('title', 'Crear Orden')

@section('content_header')
    {{-- <h1 class="flex items-center text-2xl font-bold text-gray-800">
        <i class="fas fa-concierge-bell mr-2"></i> Nueva Orden
    </h1> --}}
@stop

@section('content')
    <div class="container mx-auto px-4 py-4">
        <!-- Tabs de Categorías -->
        <nav class="flex flex-wrap gap-2 mb-4" id="categoryTabs" role="tablist">
            @foreach ($categories as $index => $category)
                <button
                    class="nav-link px-6 py-2.5 rounded-full font-medium transition-all duration-200 
                    {{ $index === 0 ? 'active bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}
                    hover:bg-blue-600 hover:text-white"
                    id="category-{{ $category->id }}-tab" 
                    data-toggle="tab" 
                    data-target="#category-{{ $category->id }}"
                    type="button" role="tab">
                    {{ $category->name }}
                </button>
            @endforeach
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sección de Productos -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md">
                    <div class="p-6">
                        <div class="tab-content" id="categoryTabsContent">
                            @foreach ($categories as $category)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="category-{{ $category->id }}" role="tabpanel">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                                        @if (isset($products[$category->id]))
                                            @foreach ($products[$category->id] as $product)
                                                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 h-[280px] flex flex-col">
                                                    <div class="relative h-32">
                                                        <img src="{{ $product->image_producto ? asset('storage/' . $product->image_producto) : asset('imagen/plato-vacio.png') }}"
                                                            class="w-full h-full object-cover rounded-t-xl {{ !$product->image_producto ? 'py-2' : '' }}" 
                                                            alt="{{ $product->name }}">
                                                    </div>
                                                    <div class="p-2.5 flex flex-col flex-1">
                                                        <h5 class="text-base font-semibold text-gray-800 line-clamp-2 mb-1.5">{{ $product->name }}</h5>
                                                        @if ($product->sizes->count() == 1)
                                                            <div class="flex flex-col mt-auto">
                                                                <div class="flex items-center justify-between mb-1.5">
                                                                    <span class="text-lg font-bold text-blue-600">
                                                                        S/. {{ $product->sizes->first()->price }}
                                                                    </span>
                                                                </div>
                                                                <button type="button"
                                                                    class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 
                                                                    transition-colors duration-200 flex items-center justify-center gap-2 btn-add-product text-sm"
                                                                    data-id="{{ $product->id }}"
                                                                    data-name="{{ $product->name }}"
                                                                    data-price="{{ $product->sizes->first()->price }}">
                                                                    <i class="fas fa-cart-plus"></i>
                                                                    <span>Agregar</span>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div class="space-y-1 mt-auto">
                                                                @foreach ($product->sizes as $size)
                                                                    <div class="flex items-center justify-between p-1.5 rounded-lg bg-gray-50 hover:bg-gray-100">
                                                                        <div>
                                                                            <span class="text-xs font-medium text-gray-600">{{ $size->type }}</span>
                                                                            <span class="block text-base font-bold text-blue-600">S/. {{ $size->price }}</span>
                                                                        </div>
                                                                        <button type="button"
                                                                            class="p-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 
                                                                            transition-all duration-200 btn-add-product flex items-center gap-2"
                                                                            data-id="{{ $product->id }}"
                                                                            data-name="{{ $product->name }}"
                                                                            data-size="{{ $size->type }}"
                                                                            data-price="{{ $size->price }}">
                                                                            <i class="fas fa-cart-plus text-sm"></i>
                                                                        </button>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
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

            <!-- Panel de Orden -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md sticky top-4">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-3 rounded-t-xl">
                        <h3 class="text-lg font-bold flex items-center gap-2">
                            <i class="fas fa-receipt"></i>
                            {{ $table->name }}
                        </h3>
                    </div>
                    <div class="p-4">
                        <!-- Info empleado y personas -->
                        <div class="grid grid-cols-2 gap-4 pb-4 border-b border-gray-200">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                        <i class="fas fa-user-circle text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Empleado</span>
                                        <strong class="block text-gray-900">{{ Auth::user()->name }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                        <i class="fas fa-users text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Personas</span>
                                        <strong class="block text-2xl text-gray-900">{{ $peopleCount }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lista de items -->
                        <div class="mt-4 max-h-[calc(100vh-400px)] overflow-y-auto hide-scrollbar">
                            <table class="w-full" id="orderItems">
                                <thead class="bg-gray-50 text-gray-600 text-sm" style="display: none;">
                                    <tr>
                                        <th class="py-2 px-2 text-left w-20">Cant.</th>
                                        <th class="py-2 px-2 text-left">Plato</th>
                                        <th class="py-2 px-2 text-right">Precio</th>
                                        <th class="py-2 px-2 text-right">Total</th>
                                        <th class="py-2 px-2 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Items se agregarán dinámicamente -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Total y acciones -->
                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-lg text-gray-600">Total:</span>
                                <span class="text-2xl font-bold text-blue-600">S/. <span id="orderTotal">0.00</span></span>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <button id="confirmOrder"
                                    class="bg-green-600 text-white rounded-lg hover:bg-green-700 
                                    transition-colors duration-200 flex items-center justify-center gap-2 text-sm py-2.5 px-4">
                                    <i class="fas fa-check text-base"></i>
                                    <span>Confirmar</span>
                                </button>
                                <a href="{{ route('order.index') }}"
                                    class="bg-red-600 text-white rounded-lg hover:bg-red-700 
                                    transition-colors duration-200 flex items-center justify-center gap-2 text-sm py-2.5 px-4">
                                    <i class="fas fa-times text-base"></i>
                                    <span>Cancelar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de selección de tamaños -->
    <div class="modal fade" id="sizeSelectionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="bg-white rounded-lg shadow-xl">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h5 class="text-xl font-semibold">Seleccionar Tamaño</h5>
                </div>
                <div class="p-6">
                    <h6 id="modalProductName" class="mb-4 text-gray-700"></h6>
                    <div id="sizeOptions" class="space-y-2">
                        <!-- Opciones de tamaño se insertarán dinámicamente -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Ocultar scrollbar pero mantener funcionalidad */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Estilos para las pestañas */
        .tab-content > .tab-pane {
            display: none;
        }

        .tab-content > .tab-pane.show.active {
            display: block;
        }

        /* Estilos para el botón activo */
        .nav-tabs .nav-link {
            border: none;
            background: transparent;
        }

        .nav-link.active {
            background-color: rgb(37, 99, 235) !important;
            color: white !important;
        }

        .nav-link.active:hover {
            background-color: rgb(37, 99, 235) !important;
            color: white !important;
        }

        /* Estilos para la tabla de orden */
        #orderTableHeader {
            display: none;
        }
        
        #orderTableHeader.show {
            display: table-header-group;
        }

        /* Asegurar mismo tamaño en cards */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Mejorar apariencia de tabla */
        #orderItems {
            border-collapse: collapse;
            width: 100%;
        }

        #orderItems th {
            position: sticky;
            top: 0;
            background: rgb(249 250 251);
            z-index: 10;
        }

        /* Ajuste para imagen genérica */
        img.py-2 {
            object-fit: contain !important;
            padding: 0.75rem 0;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar las pestañas
            const tabButtons = document.querySelectorAll('#categoryTabs button');
            const tabPanes = document.querySelectorAll('.tab-pane');

            function switchTab(targetId) {
                // Remover active de todos los botones y paneles
                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-600', 'text-white');
                    btn.classList.add('bg-white', 'text-gray-700');
                });
                tabPanes.forEach(pane => {
                    pane.classList.remove('show', 'active');
                });

                // Activar el botón y panel seleccionado
                const selectedButton = document.querySelector(`[data-target="#${targetId}"]`);
                const selectedPane = document.getElementById(targetId);

                selectedButton.classList.remove('bg-white', 'text-gray-700');
                selectedButton.classList.add('active', 'bg-blue-600', 'text-white');
                selectedPane.classList.add('show', 'active');
            }

            // Event listeners para las pestañas
            tabButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = button.getAttribute('data-target').substring(1);
                    switchTab(targetId);
                });
            });

            const orderManager = {
                items: [],

                init: function() {
                    this.bindEvents();
                    // Activar la primera pestaña al iniciar
                    const firstTab = tabButtons[0];
                    if (firstTab) {
                        const targetId = firstTab.getAttribute('data-target').substring(1);
                        switchTab(targetId);
                    }
                },

                bindEvents: function() {
                    // Agregar productos - Corregido el selector y la referencia al botón
                    document.querySelectorAll('.btn-add-product').forEach(button => {
                        button.addEventListener('click', (e) => {
                            const productButton = e.currentTarget;
                            this.addProduct({
                                id: productButton.dataset.id,
                                name: productButton.dataset.name,
                                size: productButton.dataset.size || '',
                                price: parseFloat(productButton.dataset.price)
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
                    const thead = container.querySelector('thead');
                    const tbody = container.querySelector('tbody');
                    let total = 0;

                    // Mostrar/ocultar encabezados según haya items
                    thead.style.display = this.items.length > 0 ? 'table-header-group' : 'none';

                    tbody.innerHTML = this.items.map((item, index) => {
                        const subtotal = item.price * item.quantity;
                        total += subtotal;

                        return `
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-2 px-2">
                                    <div class="flex items-center space-x-1">
                                        <button class="w-6 h-6 rounded bg-gray-200 hover:bg-gray-300 flex items-center justify-center btn-quantity" 
                                            data-index="${index}" data-change="-1">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <span class="w-6 text-center">${item.quantity}</span>
                                        <button class="w-6 h-6 rounded bg-gray-200 hover:bg-gray-300 flex items-center justify-center btn-quantity" 
                                            data-index="${index}" data-change="1">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="py-2 px-2">
                                    <div class="font-medium text-sm">${item.name}</div>
                                    ${item.size ? `<div class="text-xs text-gray-500">${item.size}</div>` : ''}
                                </td>
                                <td class="py-2 px-2 text-right text-sm">S/.${item.price.toFixed(2)}</td>
                                <td class="py-2 px-2 text-right text-sm font-medium">S/.${subtotal.toFixed(2)}</td>
                                <td class="py-2 px-2 text-center">
                                    <button class="text-red-500 hover:text-red-700 btn-remove" data-index="${index}">
                                        <i class="fas fa-times"></i>
                                    </button>
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

            orderManager.init();
        });
    </script>
@stop
