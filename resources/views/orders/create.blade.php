@extends('adminlte::page')

@section('title', 'Crear Pedido')

@section('content')
    <div class="px-4 pt-2 pb-4">
        <!-- Categorías -->
        <div class="mb-4 bg-white shadow-lg rounded-xl">
            <div class="flex gap-2 p-4 overflow-x-auto">
                @foreach($categories as $category)
                    <button class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors
                        {{ request()->category == $category->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                        onclick="filterByCategory({{ $category->id }})">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Contenedor Principal -->
        <div class="flex gap-4">
            <!-- Panel de Menús -->
            <div class="flex-1">
                <div class="bg-white shadow-lg rounded-xl">
                    <div class="grid grid-cols-2 gap-4 p-4 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($menus as $menu)
                            <div class="p-4 transition-shadow border rounded-lg cursor-pointer hover:shadow-md"
                                onclick="addToOrder({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})">
                                <img src="{{ asset($menu->image) }}" class="object-cover w-full h-32 mb-3 rounded-lg">
                                <h3 class="font-bold text-gray-800">{{ $menu->name }}</h3>
                                <p class="mb-2 text-sm text-gray-600">{{ $menu->description }}</p>
                                <p class="font-bold text-blue-600">S/. {{ number_format($menu->price, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Panel de Resumen -->
            <div class="w-96">
                <div class="p-4 bg-white shadow-lg rounded-xl">
                    <!-- Información de la Mesa y Mozo -->
                    <div class="mb-4">
                        <h3 class="mb-2 text-lg font-bold text-gray-800">Mesa: <span class="text-blue-600">{{ $table->table_number }}</span></h3>
                        <p class="text-gray-600">Mozo: {{ Auth::user()->name }}</p>
                        <p class="text-gray-600">Personas: <span id="customerCount">{{ $customerCount }}</span></p>
                    </div>

                    <!-- Tabla de Pedidos -->
                    <div class="overflow-hidden border rounded-lg">
                        <table class="w-full" id="orderTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Cant.</th>
                                    <th class="px-4 py-2 text-xs font-medium text-left text-gray-500 uppercase">Descripción</th>
                                    <th class="px-4 py-2 text-xs font-medium text-right text-gray-500 uppercase">Precio</th>
                                    <th class="px-4 py-2 text-xs font-medium text-right text-gray-500 uppercase">Subt.</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200" id="orderItems">
                                <!-- Items del pedido serán insertados aquí -->
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-4 py-2 font-bold text-right">Total:</td>
                                    <td class="px-4 py-2 font-bold text-right" id="totalAmount">S/. 0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex gap-2 mt-4">
                        <button type="button" onclick="submitOrder()"
                            class="flex-1 px-4 py-2 font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Confirmar Pedido
                        </button>
                        <a href="{{ route('orders.index') }}"
                            class="flex-1 px-4 py-2 font-bold text-center text-white bg-gray-600 rounded-lg hover:bg-gray-700">
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        let orderItems = [];

        function filterByCategory(categoryId) {
            window.location.href = `${window.location.pathname}?category=${categoryId}`;
        }

        function addToOrder(menuId, menuName, price) {
            const existingItem = orderItems.find(item => item.menuId === menuId);

            if (existingItem) {
                existingItem.quantity++;
                existingItem.subtotal = existingItem.quantity * existingItem.price;
            } else {
                orderItems.push({
                    menuId,
                    name: menuName,
                    price,
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

        function updateOrderTable() {
            const tbody = document.getElementById('orderItems');
            const total = orderItems.reduce((sum, item) => sum + item.subtotal, 0);

            tbody.innerHTML = orderItems.map((item, index) => `
                <tr>
                    <td class="px-4 py-2">${item.quantity}</td>
                    <td class="px-4 py-2">${item.name}</td>
                    <td class="px-4 py-2 text-right">S/. ${item.price.toFixed(2)}</td>
                    <td class="px-4 py-2 text-right">S/. ${item.subtotal.toFixed(2)}</td>
                    <td class="px-4 py-2 text-center">
                        <button onclick="removeItem(${index})" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            `).join('');

            document.getElementById('totalAmount').textContent = `S/. ${total.toFixed(2)}`;
        }

        function submitOrder() {
            if (orderItems.length === 0) {
                alert('Debe agregar al menos un item al pedido');
                return;
            }

            const formData = {
                table_id: '{{ $table->id }}',
                customer_count: '{{ $customerCount }}',
                items: orderItems.map(item => ({
                    menu_item_id: item.menuId,
                    quantity: item.quantity
                }))
            };

            fetch('{{ route("orders.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("orders.index") }}';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al procesar el pedido');
            });
        }
    </script>
@stop
