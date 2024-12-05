@extends('adminlte::page')

@section('title', 'Crear Pedido')

@section('content')
    <div class="h-[calc(100vh-64px)] flex flex-col px-2 sm:px-4 pt-2 pb-4">
        <!-- Tabs de categorías -->
        <div class="mb-2 sm:mb-4 bg-white rounded-lg shadow-sm">
            <div class="text-sm font-medium text-gray-500 overflow-x-auto">
                <ul class="flex flex-nowrap min-w-full sm:flex-wrap">
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
        <div class="flex flex-col lg:flex-row gap-2 sm:gap-4 flex-1 min-h-0">
            <!-- Panel de Menús -->
            <div class="flex-1 overflow-hidden h-[400px] lg:h-full lg:w-[55%] xl:w-[60%]">
                <div class="bg-white rounded-lg shadow-sm h-full">
                    <div class="grid grid-cols-2 gap-3 p-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 overflow-y-auto h-full content-start">
                        @foreach ($menus as $menu)
                            <div class="w-full p-3 transition-all border border-gray-100 rounded-lg cursor-pointer hover:shadow-sm menu-item"
                                data-category="{{ $menu->category_id }}">
                                <img src="{{ $menu->image_url ? asset($menu->image_url) : asset('imagen/plato-vacio.png') }}"
                                    class="object-cover w-full h-32 mb-3 rounded-lg">
                                <h3 class="font-bold text-gray-800 text-base sm:text-lg 2xl:text-xl mb-1">
                                    {{ $menu->name }}</h3>
                                <p class="mb-2 text-sm sm:text-base 2xl:text-lg text-gray-600 line-clamp-2">
                                    {{ $menu->description }}</p>

                                <!-- Precios por tamaño -->
                                <div class="grid grid-cols-1 gap-1.5 mt-3">
                                    @foreach ($menu->sizes as $size)
                                        <div class="group relative flex items-center justify-between p-2 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 cursor-pointer shadow-sm hover:shadow-md"
                                            onclick="addToOrder({{ $menu->id }}, '{{ $menu->name }}', {{ $size->pivot->price }}, '{{ $size->size_name }}')">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-xs sm:text-sm font-medium text-gray-700 group-hover:text-blue-700">
                                                    {{ $size->size_name }}
                                                </span>
                                            </div>
                                            <div class="flex items-center">
                                                <p class="font-bold text-blue-600 text-sm sm:text-base group-hover:text-blue-700">
                                                    S/. {{ number_format($size->pivot->price, 2) }}
                                                </p>
                                                <i class="fas fa-plus-circle ml-2 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                                            </div>
                                            <div class="absolute inset-0 rounded-lg border-2 border-transparent group-hover:border-blue-500 pointer-events-none"></div>
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
                <div class="bg-white rounded-lg shadow-sm flex-1 flex flex-col overflow-hidden">
                    <!-- Información de la Mesa y Mozo -->
                    <div class="p-2 sm:p-4 border-b">
                        <h3 class="mb-1 sm:mb-2 text-base sm:text-lg font-bold text-gray-800">Mesa: <span
                                class="text-blue-600">{{ $table->table_number }}</span></h3>
                        <p class="text-sm sm:text-base text-gray-600">Mozo: {{ Auth::user()->name }}</p>
                        <p class="text-sm sm:text-base text-gray-600">Personas: <span
                                id="customerCount">{{ $customerCount }}</span></p>
                    </div>

                    <!-- Tabla de Pedidos -->
                    <div class="flex-1 overflow-y-auto p-2 sm:p-4">
                        <div class="border rounded-lg overflow-hidden">
                            <table class="w-full text-sm sm:text-base" id="orderTable">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-2 py-2 text-xs sm:text-sm font-medium text-center text-gray-500 uppercase w-24">Cant.</th>
                                        <th class="px-2 py-2 text-xs sm:text-sm font-medium text-left text-gray-500 uppercase">Descripción</th>
                                        <th class="px-2 py-2 text-xs sm:text-sm font-medium text-right text-gray-500 uppercase w-20 lg:w-24">P.U.</th>
                                        <th class="px-2 py-2 text-xs sm:text-sm font-medium text-right text-gray-500 uppercase w-20 lg:w-24">Subt.</th>
                                        <th class="px-2 py-2 text-xs sm:text-sm font-medium text-center text-gray-500 uppercase w-20">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200" id="orderItems">
                                    <!-- Items del pedido serán insertados aquí -->
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-base sm:text-lg font-bold text-right">Total:</td>
                                        <td class="px-4 py-2 text-base sm:text-lg font-bold text-right" id="totalAmount">S/. 0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="p-2 sm:p-4 border-t">
                        <form id="orderForm" method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <input type="hidden" name="table_id" value="{{ $table->id }}">
                            <input type="hidden" name="customer_count" value="{{ $customerCount }}">
                            <input type="hidden" name="order_items" id="orderItemsInput">

                            <div class="flex gap-2">
                                <button type="button" onclick="prepareAndSubmitForm()"
                                    class="flex-1 px-3 sm:px-4 py-2 font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 text-sm sm:text-base">
                                    Confirmar Pedido
                                </button>
                                <a href="{{ route('orders.index') }}"
                                    class="flex-1 px-3 sm:px-4 py-2 font-bold text-center text-white bg-gray-600 rounded-lg hover:bg-gray-700 text-sm sm:text-base">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para notas -->
    <div id="noteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-bold mb-4">Añadir nota especial</h3>
            <textarea id="noteText" rows="4" 
                class="w-full p-2 border rounded-lg mb-4 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                placeholder="Escribe las indicaciones especiales aquí..."></textarea>
            <div class="flex justify-end space-x-2">
                <button onclick="closeNoteModal()" 
                    class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                    Cancelar
                </button>
                <button onclick="saveNote()" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
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
    let commandStatus = '{{ $commandStatus ?? "" }}';

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
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <span class="w-6 text-center text-sm">${item.quantity}</span>
                            <button onclick="updateQuantity(${index}, true)"
                                    class="p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        ` : `
                            <span class="w-6 text-center text-sm font-medium">${item.quantity}</span>
                        `}
                    </div>
                </td>
                <td class="px-2 py-2 text-sm">
                    <div class="flex flex-col">
                        <span>${item.name} <span class="text-gray-500">(${item.sizeName})</span></span>
                        ${item.special_requests ? `<span class="text-xs text-gray-500 italic">Nota: ${item.special_requests}</span>` : ''}
                        ${item.isCompleted ? '<span class="text-xs text-green-500 font-medium">Completado</span>' : ''}
                    </div>
                </td>
                <td class="px-2 py-2 text-right text-sm">S/. ${item.price.toFixed(2)}</td>
                <td class="px-2 py-2 text-right text-sm">S/. ${item.subtotal.toFixed(2)}</td>
                <td class="px-2 py-2">
                    <div class="flex justify-center space-x-1">
                        ${!item.isCompleted ? `
                            <button onclick="addNote(${index})" 
                                    class="p-1 text-blue-600 hover:text-blue-800 focus:outline-none" 
                                    title="Añadir nota especial">
                                <i class="fas fa-comment text-sm"></i>
                            </button>
                            <button onclick="removeItem(${index})" 
                                    class="p-1 text-red-600 hover:text-red-800 focus:outline-none"
                                    title="Eliminar item">
                                <i class="fas fa-times text-sm"></i>
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
            table_id: {{ $table->id }},
            customer_count: {{ $customerCount }},
            items: orderItems.map(item => ({
                menu_item_id: item.menuId,
                quantity: item.quantity,
                price: item.price,
                special_requests: item.special_requests || null
            }))
        };

        const url = isEditing 
            ? '{{ isset($existingOrder) ? route("orders.update", $existingOrder->id) : "" }}'
            : '{{ route("orders.store") }}';
        
        const method = isEditing ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
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
                window.location.href = '{{ route("orders.index") }}';
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
