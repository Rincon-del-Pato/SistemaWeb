@extends('adminlte::page')

@section('title', 'Crear Pedido')

@section('content')
    <div class="h-[calc(100vh-64px)] flex flex-col px-2 sm:px-4 pt-2 pb-4">
        <!-- Header con tipo de orden -->
        <div class="mb-2 bg-white rounded-lg shadow-sm sm:mb-4">
            <div class="p-3 sm:p-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800">
                        @if ($orderType === 'ParaLlevar')
                            <i class="mr-2 fas fa-shopping-bag"></i> Nueva Orden Para Llevar
                        @else
                            <i class="mr-2 fas fa-chair"></i> Nueva Orden Local - Mesa: {{ $table->table_number ?? '' }}
                        @endif
                    </h3>
                </div>
            </div>
        </div>

        <!-- Tabs de categorías -->
        <div class="mb-2 bg-white rounded-lg shadow-sm sm:mb-4">
            <div class="overflow-x-auto text-sm font-medium text-gray-500">
                <ul class="flex min-w-full flex-nowrap sm:flex-wrap">
                    <li class="shrink-0">
                        <a href="#"
                            class="tab-button inline-block px-6 py-3 border-b-2 transition-colors
                            {{ request()->category === null ? 'text-blue-600 border-blue-600' : 'border-transparent hover:border-gray-300' }}"
                            onclick="filterByCategory('all', event)" role="tab">
                            Todos
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="shrink-0">
                            <a href="#"
                                class="tab-button inline-block px-6 py-3 border-b-2 transition-colors
                                {{ request()->category == $category->id ? 'text-blue-600 border-blue-600' : 'border-transparent hover:border-gray-300' }}"
                                onclick="filterByCategory({{ $category->id }}, event)" role="tab">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Contenedor Principal -->
        <div class="flex flex-col flex-1 min-h-0 gap-2 lg:flex-row sm:gap-4">
            <!-- Panel de Menús -->
            <div class="flex-1 overflow-hidden h-[400px] lg:h-full lg:w-[55%] xl:w-[60%]">
                <div class="h-full bg-white rounded-lg shadow-sm">
                    <div
                        class="grid content-start h-full grid-cols-2 gap-3 p-4 overflow-y-auto md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                        @foreach ($menus as $menu)
                            <div class="w-full p-3 transition-all border border-gray-100 rounded-lg cursor-pointer hover:shadow-sm menu-item"
                                data-category="{{ $menu->category_id }}">
                                <img src="{{ $menu->image_url ? asset($menu->image_url) : asset('imagen/plato-vacio.png') }}"
                                    class="object-cover w-full h-32 mb-3 rounded-lg">
                                <h3 class="mb-1 text-base font-bold text-gray-800 sm:text-lg 2xl:text-xl">
                                    {{ $menu->name }}</h3>
                                <p class="mb-2 text-sm text-gray-600 sm:text-base 2xl:text-lg line-clamp-2">
                                    {{ $menu->description }}</p>

                                <!-- Precios por tamaño -->
                                <div class="grid grid-cols-1 gap-1.5 mt-3">
                                    @foreach ($menu->sizes as $size)
                                        <div class="relative flex items-center justify-between p-2 transition-all duration-200 border border-gray-200 rounded-lg shadow-sm cursor-pointer group hover:border-blue-500 hover:bg-blue-50 hover:shadow-md"
                                            onclick="addToOrder({{ $menu->id }}, '{{ $menu->name }}', {{ $size->pivot->price }}, '{{ $size->size_name }}')">
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="text-xs font-medium text-gray-700 sm:text-sm group-hover:text-blue-700">
                                                    {{ $size->size_name }}
                                                </span>
                                            </div>
                                            <div class="flex items-center">
                                                <p
                                                    class="text-sm font-bold text-blue-600 sm:text-base group-hover:text-blue-700">
                                                    S/. {{ number_format($size->pivot->price, 2) }}
                                                </p>
                                                <i
                                                    class="ml-2 text-gray-400 transition-colors fas fa-plus-circle group-hover:text-blue-500"></i>
                                            </div>
                                            <div
                                                class="absolute inset-0 border-2 border-transparent rounded-lg pointer-events-none group-hover:border-blue-500">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Panel de Resumen -->
            <div class="lg:w-[45%] xl:w-[40%] flex flex-col h-[500px] lg:h-full">
                <div class="flex flex-col flex-1 overflow-hidden bg-white rounded-lg shadow-sm">
                    <!-- Información de la Mesa y Mozo -->
                    <div class="p-2 border-b sm:p-4">
                        <h3 class="mb-1 text-base font-bold text-gray-800 sm:mb-2 sm:text-lg">
                            @if ($orderType === 'ParaLlevar')
                                <span class="text-blue-600">Orden Para Llevar</span>
                            @elseif ($orderType === 'Delivery')
                                <span class="text-blue-600">Orden Delivery</span>
                                <!-- Solo el campo de dirección para delivery -->
                                <div class="mt-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Dirección de Entrega</label>
                                        <textarea id="deliveryAddress" class="w-full p-2 mt-1 border rounded-md" rows="2" 
                                            placeholder="Ingrese la dirección de entrega completa"></textarea>
                                    </div>
                                </div>
                            @else
                                Mesa: <span class="text-blue-600">{{ $table->table_number }}</span>
                                <p class="text-sm text-gray-600 sm:text-base">Personas: <span id="customerCount">{{ $customerCount }}</span></p>
                            @endif
                        </h3>
                        <p class="text-sm text-gray-600 sm:text-base">Mozo: {{ Auth::user()->name }}</p>
                    </div>

                    <!-- Tabla de Pedidos -->
                    <div class="flex-1 p-2 overflow-y-auto sm:p-4">
                        <div class="overflow-hidden border rounded-lg">
                            <table class="w-full text-sm sm:text-base" id="orderTable">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="w-24 px-2 py-2 text-xs font-medium text-center text-gray-500 uppercase sm:text-sm">
                                            Cant.</th>
                                        <th
                                            class="px-2 py-2 text-xs font-medium text-left text-gray-500 uppercase sm:text-sm">
                                            Descripción</th>
                                        <th
                                            class="w-20 px-2 py-2 text-xs font-medium text-right text-gray-500 uppercase sm:text-sm lg:w-24">
                                            P.U.</th>
                                        <th
                                            class="w-20 px-2 py-2 text-xs font-medium text-right text-gray-500 uppercase sm:text-sm lg:w-24">
                                            Subt.</th>
                                        <th
                                            class="w-20 px-2 py-2 text-xs font-medium text-center text-gray-500 uppercase sm:text-sm">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200" id="orderItems">
                                    <!-- Items del pedido serán insertados aquí -->
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-base font-bold text-right sm:text-lg">
                                            Total:</td>
                                        <td class="px-4 py-2 text-base font-bold text-right sm:text-lg" id="totalAmount">S/.
                                            0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="p-2 border-t sm:p-4">
                        <form id="orderForm" method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            @if ($orderType === 'Local')
                                <input type="hidden" name="table_id" value="{{ $table->id }}">
                                <input type="hidden" name="customer_count" value="{{ $customerCount }}">
                            @endif
                            <input type="hidden" name="order_type" value="{{ $orderType }}">
                            <input type="hidden" name="order_items" id="orderItemsInput">

                            <div class="flex gap-2">
                                <button type="button" onclick="prepareAndSubmitForm()"
                                    class="flex-1 px-3 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg sm:px-4 hover:bg-blue-700 sm:text-base">
                                    Confirmar Pedido
                                </button>
                                <a href="{{ route('orders.index') }}"
                                    class="flex-1 px-3 py-2 text-sm font-bold text-center text-white bg-gray-600 rounded-lg sm:px-4 hover:bg-gray-700 sm:text-base">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal para notas -->
    <div id="noteModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-full max-w-md p-6 mx-4 bg-white rounded-lg">
            <h3 class="mb-4 text-lg font-bold">Añadir nota especial</h3>
            <textarea id="noteText" rows="4"
                class="w-full p-2 mb-4 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                placeholder="Escribe las indicaciones especiales aquí..."></textarea>
            <div class="flex justify-end space-x-2">
                <button onclick="closeNoteModal()" class="px-4 py-2 font-medium text-gray-600 hover:text-gray-800">
                    Cancelar
                </button>
                <button onclick="saveNote()"
                    class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        let orderItems = @json($existingOrderItems ?? []);
        let currentEditingIndex = null;
        let isEditing = {{ isset($existingOrder) ? 'true' : 'false' }};
        let commandStatus = '{{ $commandStatus ?? '' }}';

        function filterByCategory(categoryId, event) {
            event.preventDefault();

            // Actualizar clases de los tabs
            document.querySelectorAll('.tab-button').forEach(tab => {
                tab.classList.remove('text-blue-600', 'border-blue-600');
                tab.classList.add('border-transparent');
            });
            event.currentTarget.classList.remove('border-transparent');
            event.currentTarget.classList.add('text-blue-600', 'border-blue-600');

            // Filtrar los menús
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                if (categoryId === 'all' || item.dataset.category === categoryId.toString()) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function addToOrder(menuId, menuName, price, sizeName) {
            const existingItem = orderItems.find(item =>
                item.menuId === menuId && item.sizeName === sizeName
            );

            if (existingItem) {
                existingItem.quantity++;
                existingItem.subtotal = existingItem.quantity * existingItem.price;
            } else {
                orderItems.push({
                    menuId,
                    name: menuName,
                    price,
                    sizeName,
                    quantity: 1,
                    subtotal: price
                });
            }

            updateOrderTable();
        }

        function removeItem(index) {
            orderItems.splice(index, 1);
            updateOrderTable();
        }

        function updateQuantity(index, increment) {
            const item = orderItems[index];
            if (increment) {
                item.quantity++;
            } else if (item.quantity > 1) {
                item.quantity--;
            }
            item.subtotal = item.quantity * item.price;
            updateOrderTable();
        }

        function addNote(index) {
            currentEditingIndex = index;
            const item = orderItems[index];
            document.getElementById('noteText').value = item.special_requests || '';
            document.getElementById('noteModal').classList.remove('hidden');
            document.getElementById('noteModal').classList.add('flex');
        }

        function closeNoteModal() {
            document.getElementById('noteModal').classList.add('hidden');
            document.getElementById('noteModal').classList.remove('flex');
            currentEditingIndex = null;
        }

        function saveNote() {
            const note = document.getElementById('noteText').value.trim();
            if (currentEditingIndex !== null) {
                orderItems[currentEditingIndex].special_requests = note;
                updateOrderTable();
            }
            closeNoteModal();
        }

        function updateOrderTable() {
            const tbody = document.getElementById('orderItems');
            const total = orderItems.reduce((sum, item) => sum + item.subtotal, 0);

            tbody.innerHTML = orderItems.map((item, index) => `
            <tr class="hover:bg-gray-50">
                <td class="px-2 py-2 text-center">
                    <div class="flex items-center justify-center space-x-1">
                        ${!item.isCompleted ? `
                                <button onclick="updateQuantity(${index}, false)"
                                        class="p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="text-xs fas fa-minus"></i>
                                </button>
                                <span class="w-6 text-sm text-center">${item.quantity}</span>
                                <button onclick="updateQuantity(${index}, true)"
                                        class="p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="text-xs fas fa-plus"></i>
                                </button>
                            ` : `
                                <span class="w-6 text-sm font-medium text-center">${item.quantity}</span>
                            `}
                    </div>
                </td>
                <td class="px-2 py-2 text-sm">
                    <div class="flex flex-col">
                        <span>${item.name} <span class="text-gray-500">(${item.sizeName})</span></span>
                        ${item.special_requests ? `<span class="text-xs italic text-gray-500">Nota: ${item.special_requests}</span>` : ''}
                        ${item.isCompleted ? '<span class="text-xs font-medium text-green-500">Completado</span>' : ''}
                    </div>
                </td>
                <td class="px-2 py-2 text-sm text-right">S/. ${item.price.toFixed(2)}</td>
                <td class="px-2 py-2 text-sm text-right">S/. ${item.subtotal.toFixed(2)}</td>
                <td class="px-2 py-2">
                    <div class="flex justify-center space-x-1">
                        ${!item.isCompleted ? `
                                <button onclick="addNote(${index})"
                                        class="p-1 text-blue-600 hover:text-blue-800 focus:outline-none"
                                        title="Añadir nota especial">
                                    <i class="text-sm fas fa-comment"></i>
                                </button>
                                <button onclick="removeItem(${index})"
                                        class="p-1 text-red-600 hover:text-red-800 focus:outline-none"
                                        title="Eliminar item">
                                    <i class="text-sm fas fa-times"></i>
                                </button>
                            ` : ''}
                    </div>
                </td>
            </tr>
        `).join('');

            document.getElementById('totalAmount').textContent = `S/. ${total.toFixed(2)}`;
        }

        function prepareAndSubmitForm() {
            if (orderItems.length === 0) {
                alert('Debe agregar al menos un item al pedido');
                return;
            }

            const formData = {
                order_type: '{{ $orderType }}',
                items: orderItems.map(item => ({
                    menu_item_id: item.menuId,
                    quantity: item.quantity,
                    price: item.price,
                    special_requests: item.special_requests || null
                }))
            };

            // Agregar datos según el tipo de orden
            if ('{{ $orderType }}' === 'Local') {
                formData.table_id = {{ $table->id ?? 'null' }};
                formData.customer_count = {{ $customerCount ?? 1 }};
            } else if ('{{ $orderType }}' === 'Delivery') {
                formData.delivery_address = document.getElementById('deliveryAddress').value;

                // Validar solo la dirección
                if (!formData.delivery_address) {
                    alert('Por favor ingrese la dirección de entrega');
                    return;
                }
            }

            fetch('{{ route('orders.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirigir a payment si es ParaLlevar, sino a index
                        if ('{{ $orderType }}' === 'ParaLlevar') {
                            window.location.href = `/orders/${data.orderId}/payment`;
                        } else {
                            window.location.href = '{{ route('orders.index') }}';
                        }
                    } else {
                        throw new Error(data.message || 'Error al procesar la orden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar el pedido: ' + error.message);
                });
        }

        // Cargar los items existentes al iniciar la página
        window.addEventListener('DOMContentLoaded', (event) => {
            if (orderItems.length > 0) {
                updateOrderTable();
            }
        });
    </script>
@stop
