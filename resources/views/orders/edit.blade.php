@extends('adminlte::page')

@section('title', 'Editar Pedido')

@section('content')
<div class="h-[calc(100vh-64px)] flex flex-col px-2 sm:px-4 pt-2 pb-4">
    <!-- Tabs de categorías -->
    <div class="mb-2 bg-white rounded-lg shadow-sm sm:mb-4">
        <div class="overflow-x-auto text-sm font-medium text-gray-500">
            <ul class="flex min-w-full flex-nowrap sm:flex-wrap">
                <li class="shrink-0">
                    <a href="#" class="tab-button inline-block px-6 py-3 border-b-2 transition-colors
                        {{ request()->category === null ? 'text-blue-600 border-blue-600' : 'border-transparent hover:border-gray-300' }}"
                        onclick="filterByCategory('all', event)" role="tab">
                        Todos
                    </a>
                </li>
                @foreach ($categories as $category)
                    <li class="shrink-0">
                        <a href="#" class="tab-button inline-block px-6 py-3 border-b-2 transition-colors
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
                <div class="grid content-start h-full grid-cols-2 gap-3 p-4 overflow-y-auto md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
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
                                            <span class="text-xs font-medium text-gray-700 sm:text-sm group-hover:text-blue-700">
                                                {{ $size->size_name }}
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <p class="text-sm font-bold text-blue-600 sm:text-base group-hover:text-blue-700">
                                                S/. {{ number_format($size->pivot->price, 2) }}
                                            </p>
                                            <i class="ml-2 text-gray-400 transition-colors fas fa-plus-circle group-hover:text-blue-500"></i>
                                        </div>
                                        <div class="absolute inset-0 border-2 border-transparent rounded-lg pointer-events-none group-hover:border-blue-500"></div>
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
                    <h3 class="mb-1 text-base font-bold text-gray-800 sm:mb-2 sm:text-lg">Mesa:
                        <span class="text-blue-600">{{ $order->table->table_number }}</span>
                    </h3>
                    <p class="text-sm text-gray-600 sm:text-base">Mozo: {{ $order->user->name }}</p>
                    <p class="text-sm text-gray-600 sm:text-base">Personas: {{ $order->num_guests }}</p>
                </div>

                <!-- Tabla de Pedidos -->
                <div class="flex-1 p-2 overflow-y-auto sm:p-4">
                    <div class="overflow-hidden border rounded-lg">
                        <table class="w-full text-sm sm:text-base" id="orderTable">
                            <thead class="bg-gray-50">
                                <!-- ...existing code for table header... -->
                            </thead>
                            <tbody class="divide-y divide-gray-200" id="orderItems">
                                <!-- Items serán cargados dinámicamente -->
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-base font-bold text-right sm:text-lg">Total:</td>
                                    <td class="px-4 py-2 text-base font-bold text-right sm:text-lg" id="totalAmount">S/. 0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="p-2 border-t sm:p-4">
                    <div class="flex gap-2">
                        <button type="button" onclick="prepareAndSubmitForm()"
                            class="flex-1 px-3 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg sm:px-4 hover:bg-blue-700 sm:text-base">
                            Actualizar Pedido
                        </button>
                        <a href="{{ route('orders.index') }}"
                            class="flex-1 px-3 py-2 text-sm font-bold text-center text-white bg-gray-600 rounded-lg sm:px-4 hover:bg-gray-700 sm:text-base">
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para notas -->
<div id="noteModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
    <!-- ...existing code for note modal... -->
</div>
@stop

@section('js')
<script>
    // Inicializar orderItems incluyendo el estado de edición
    let orderItems = {!! json_encode($order->orderItems->map(function($item) {
        return [
            'menuId' => $item->menu_item_id,
            'name' => $item->menuItem->name,
            'price' => floatval($item->price),
            'sizeName' => $item->size ?? 'Regular',
            'quantity' => $item->quantity,
            'subtotal' => $item->price * $item->quantity,
            'special_requests' => $item->special_requests ?? '',
            'commandStatus' => $item->commandStatus,
            'isEditable' => $item->isEditable
        ];
    })) !!};

    let currentEditingIndex = null;

    // Función para filtrar categorías
    function filterByCategory(categoryId, event) {
        event.preventDefault();

        // Remover clase activa de todos los tabs
        document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('text-blue-600', 'border-blue-600');
            tab.classList.add('border-transparent');
        });

        // Agregar clase activa al tab seleccionado
        event.currentTarget.classList.remove('border-transparent');
        event.currentTarget.classList.add('text-blue-600', 'border-blue-600');

        // Filtrar menús
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
        // Primero buscar si existe el item
        const existingItem = orderItems.find(item =>
            item.menuId === menuId && item.sizeName === sizeName
        );

        if (existingItem) {
            // Solo incrementar si el item es editable
            if (existingItem.isEditable) {
                existingItem.quantity++;
                existingItem.subtotal = existingItem.quantity * existingItem.price;
            }
        } else {
            // Los nuevos items siempre son editables
            orderItems.push({
                menuId,
                name: menuName,
                price,
                sizeName,
                quantity: 1,
                subtotal: price,
                special_requests: '',
                commandStatus: null, // Nuevo item sin estado de comanda
                isEditable: true    // Nuevos items siempre editables
            });
        }

        updateOrderTable();
    }

    // Funciones de manipulación de items (igual que en create.blade.php)
    function removeItem(index) {
        const item = orderItems[index];
        if (!item.isEditable) return; // Prevenir cambios si no es editable

        orderItems.splice(index, 1);
        updateOrderTable();
    }

    function updateQuantity(index, increment) {
        const item = orderItems[index];
        if (!item.isEditable) return; // Prevenir cambios si no es editable

        if (increment) {
            item.quantity++;
        } else if (item.quantity > 1) {
            item.quantity--;
        }
        item.subtotal = item.quantity * item.price;
        updateOrderTable();
    }

    function addNote(index) {
        const item = orderItems[index];
        if (!item.isEditable) return; // Prevenir cambios si no es editable

        // ...existing code from create.blade.php...
    }

    function closeNoteModal() {
        // ...existing code from create.blade.php...
    }

    function saveNote() {
        // ...existing code from create.blade.php...
    }

    function updateOrderTable() {
        const tbody = document.getElementById('orderItems');
        const total = orderItems.reduce((sum, item) => sum + item.subtotal, 0);

        tbody.innerHTML = orderItems.map((item, index) => `
            <tr class="${!item.isEditable ? 'bg-gray-100' : 'hover:bg-gray-50'}">
                <td class="px-2 py-2 text-center">
                    <div class="flex items-center justify-center space-x-1">
                        ${item.isEditable ? `
                            <button onclick="updateQuantity(${index}, false)"
                                    class="p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="text-xs fas fa-minus"></i>
                            </button>
                            <span class="w-6 text-center text-sm">${item.quantity}</span>
                            <button onclick="updateQuantity(${index}, true)"
                                    class="p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="text-xs fas fa-plus"></i>
                            </button>
                        ` : `
                            <span class="w-6 text-center text-sm text-gray-500">${item.quantity}</span>
                        `}
                    </div>
                </td>
                <td class="px-2 py-2 text-sm">
                    <div class="flex flex-col">
                        <span class="${!item.isEditable ? 'text-gray-500' : ''}">${item.name}
                            <span class="text-gray-500">(${item.sizeName})</span>
                        </span>
                        ${item.special_requests ? `
                            <span class="text-xs italic text-gray-500">Nota: ${item.special_requests}</span>
                        ` : ''}
                        ${item.commandStatus ? `
                            <span class="text-xs font-medium ${item.commandStatus === 'Pendiente' ? 'text-yellow-500' : 'text-blue-500'}">
                                Estado: ${item.commandStatus}
                            </span>
                        ` : ''}
                    </div>
                </td>
                <td class="px-2 py-2 text-right text-sm ${!item.isEditable ? 'text-gray-500' : ''}">
                    S/. ${item.price.toFixed(2)}
                </td>
                <td class="px-2 py-2 text-right text-sm ${!item.isEditable ? 'text-gray-500' : ''}">
                    S/. ${item.subtotal.toFixed(2)}
                </td>
                <td class="px-2 py-2">
                    <div class="flex justify-center space-x-1">
                        ${item.isEditable ? `
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
                        ` : `
                            <span class="p-1" title="No se puede editar">
                                <i class="text-sm fas fa-comment text-gray-400"></i>
                            </span>
                            <span class="p-1" title="No se puede eliminar">
                                <i class="text-sm fas fa-times text-gray-400"></i>
                            </span>
                        `}
                    </div>
                </td>
            </tr>
        `).join('');

        document.getElementById('totalAmount').textContent = `S/. ${total.toFixed(2)}`;
    }

    // Modifica la función prepareAndSubmitForm
    function prepareAndSubmitForm() {
        if (orderItems.length === 0) {
            alert('Debe tener al menos un item en el pedido');
            return;
        }

        const formData = {
            _method: 'PUT',
            items: orderItems.map(item => ({
                menu_item_id: item.menuId,
                quantity: item.quantity,
                price: item.price,
                special_requests: item.special_requests || null,
                is_new: !item.commandStatus // Los ítems sin commandStatus son nuevos
            }))
        };

        fetch('{{ route("orders.update", $order->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("orders.index") }}';
            } else {
                throw new Error(data.message || 'Error al actualizar la orden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar el pedido: ' + (error.message || 'Error desconocido'));
        });
    }

    // Cargar los items existentes al iniciar la página
    window.addEventListener('DOMContentLoaded', (event) => {
        updateOrderTable();
    });
</script>
@stop
