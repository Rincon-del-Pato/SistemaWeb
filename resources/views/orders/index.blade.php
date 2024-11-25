@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
    <div class="px-4 pt-2 pb-4">
        <div class="flex justify-center space-x-4">
            <!-- Panel principal (contenedor de cards) -->
            <div id="mainPanel" class="flex-1 max-w-7xl">
                <div class="bg-white shadow-lg rounded-xl">
                    <div class="p-6 border-b">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-3">
                                <span
                                    class="px-4 py-2 text-sm font-semibold text-white bg-green-500 rounded-lg shadow-sm hover:bg-green-600">
                                    <i class="mr-2 fas fa-check-circle"></i>
                                    {{ $availableCount }} Libre
                                </span>
                                <span
                                    class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-lg shadow-sm hover:bg-red-600">
                                    <i class="mr-2 fas fa-times-circle"></i>
                                    {{ $occupiedCount }} Ocupado
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 p-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8"
                        id="tablesGrid">
                        @foreach ($tables as $table)
                            <div class="relative shadow-lg rounded-lg border-2 overflow-hidden
                                {{ $table->status->value === 'Disponible' ? 'border-green-600 bg-green-50' : 'border-red-600 bg-red-50' }}
                                cursor-pointer hover:shadow-xl transition-all duration-300"
                                onclick="selectTable({{ $table->id }}, {{ $table->seating_capacity }}, '{{ $table->table_number }}', '{{ $table->status->value }}')">

                                <div class="flex flex-col items-center p-2">
                                    <!-- Número de mesa -->
                                    <h4 class="text-lg font-bold text-gray-800">{{ $table->table_number }}</h4>

                                    @if ($table->status->value === 'Ocupado')
                                        <!-- Mozo que atiende -->
                                        <p class="text-sm text-gray-600">
                                            <i class="mr-1 fas fa-user-tie"></i>
                                            {{ $table->waiterName }}
                                        </p>

                                        <!-- Imagen de la mesa -->
                                        <img src="{{ asset('imagen/mesa-llena.png') }}" class="w-12 h-12 my-1">

                                        <!-- Información de mesa ocupada -->
                                        <div class="flex items-center justify-between gap-3 text-sm text-gray-600">
                                            <div class="flex items-center gap-1">
                                                <i class="fas fa-users"></i>
                                                <span>{{ $table->num_guests }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="far fa-clock"></i>
                                                @php
                                                    $created = new DateTime($table->orders->first()->created_at);
                                                    $now = new DateTime();
                                                    $interval = $created->diff($now);
                                                    if ($interval->h > 0) {
                                                        $timeDisplay = $interval->h . 'h ' . $interval->i . 'm';
                                                    } else {
                                                        $timeDisplay = $interval->i . ' min';
                                                    }
                                                @endphp
                                                <span>{{ $timeDisplay }}</span>
                                            </div>

                                        </div>

                                        <!-- Total de la orden -->
                                        <div class="text-sm font-semibold text-gray-800">
                                            Total: S/. {{ number_format($table->orders->first()->total, 2) }}
                                        </div>
                                    @else
                                        <!-- Imagen de la mesa -->
                                        <img src="{{ asset('imagen/mesa-vacia.png') }}" class="w-12 h-12 my-1">

                                        <!-- Indicador de disponible -->
                                        <div class="flex flex-col items-center gap-2 text-green-600">
                                            <i class="text-lg fas fa-check-circle"></i>
                                            <span class="text-sm font-semibold">Libre</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- Panel lateral (formulario) -->
            <div id="sidePanel" class="w-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="bg-white shadow-lg w-96 rounded-xl">
                    <!-- Panel para mesa libre -->
                    <div id="freeTablePanel" class="hidden">
                        <div class="p-4 border-b">
                            <h5 class="text-xl font-bold text-gray-800">Mesa: <span id="selectedTable">Ninguna</span></h5>
                        </div>
                        <div class="px-4 py-6">
                            <form id="capacityForm" action="{{ route('orders.create') }}" method="GET" class="space-y-6">
                                <input type="hidden" name="table_id" id="selectedTableId">
                                <input type="hidden" name="customer_count" id="customerCount">

                                <!-- Número de personas -->
                                <div>
                                    <label class="block mb-2 text-sm font-bold text-gray-700">Número de personas</label>
                                    <div class="relative w-full">
                                        <div class="flex items-center overflow-hidden border border-gray-300 rounded-lg">
                                            <button type="button" onclick="decreasePeopleCount()"
                                                class="px-6 py-2 text-lg font-bold bg-gray-100 border-r border-gray-300 hover:bg-gray-200">-</button>
                                            <input type="number" id="peopleCount" value="1" min="1"
                                                class="flex-1 py-1 text-xl font-medium text-center border-none focus:outline-none focus:ring-0">
                                            <button type="button" onclick="increasePeopleCount()"
                                                class="px-6 py-2 text-lg font-bold bg-gray-100 border-l border-gray-300 hover:bg-gray-200">+</button>
                                        </div>
                                        <div class="mt-1 text-xs text-right text-gray-500">
                                            Capacidad máxima: <span id="maxCapacity">-</span> personas
                                        </div>
                                    </div>
                                </div>

                                <!-- Información del Mozo -->
                                <div class="pt-4 border-t">
                                    <label class="block mb-2 text-sm font-bold text-gray-700">Mozo asignado</label>
                                    <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                                        <i class="text-gray-600 fas fa-user-tie"></i>
                                        <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="flex gap-4">
                                    <button type="submit"
                                        class="w-full px-4 py-2 font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Continuar
                                    </button>
                                    <button type="button" onclick="closeSidePanel()"
                                        class="w-full px-4 py-2 font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Panel para mesa ocupada -->
                    <div id="occupiedTablePanel" class="hidden">
                        <!-- Header con información -->
                        <div class="bg-gray-50 p-4">
                            <div class="flex flex-col space-y-2">
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-chair text-gray-600 mr-2"></i>
                                        <span class="text-lg font-bold">Mesa:</span>
                                        <span class="text-lg font-bold text-blue-600 ml-2" id="tableInfo"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-user-tie text-gray-600 mr-2"></i>
                                        <span class="text-md font-medium text-gray-700" id="waiterInfo"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lista de pedidos -->
                        <div class="p-4 overflow-y-auto" style="max-height: 400px">
                            <h6 class="mb-3 text-sm font-bold text-gray-700">Pedidos de la mesa</h6>
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-xs font-semibold text-left text-gray-600">Cant.</th>
                                        <th class="px-4 py-2 text-xs font-semibold text-left text-gray-600">Descripción</th>
                                        <th class="px-4 py-2 text-xs font-semibold text-right text-gray-600">Precio</th>
                                    </tr>
                                </thead>
                                <tbody id="orderItemsList" class="divide-y divide-gray-100">
                                    <!-- Los items se cargarán dinámicamente aquí -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Resumen y acciones -->
                        <div class="p-4 border-t bg-gray-50">
                            <!-- Total -->
                            <div class="mb-4 text-center">
                                <p class="text-sm text-gray-600">Total de la cuenta</p>
                                <p class="text-2xl font-bold text-gray-800" id="totalAmount">S/. 0.00</p>
                            </div>

                            <!-- Botones de acción -->
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" onclick="addNewOrder()"
                                    class="px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="mr-1 fas fa-plus"></i>
                                    Agregar Pedido
                                </button>
                                <button type="button" onclick="processPayment()"
                                    class="px-4 py-2 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-700">
                                    <i class="mr-1 fas fa-cash-register"></i>
                                    Cobrar Cuenta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        function adjustGridLayout(isOpen) {
            const tablesGrid = document.getElementById('tablesGrid');
            if (isOpen) {
                tablesGrid.classList.remove('lg:grid-cols-6', 'xl:grid-cols-8');
                tablesGrid.classList.add('lg:grid-cols-4', 'xl:grid-cols-6');
            } else {
                tablesGrid.classList.remove('lg:grid-cols-4', 'xl:grid-cols-6');
                tablesGrid.classList.add('lg:grid-cols-6', 'xl:grid-cols-8');
            }
        }

        function selectTable(tableId, capacity, tableName, status) {
            const sidePanel = document.getElementById('sidePanel');
            const freeTablePanel = document.getElementById('freeTablePanel');
            const occupiedTablePanel = document.getElementById('occupiedTablePanel');

            sidePanel.classList.remove('w-0');
            sidePanel.classList.add('w-96');
            adjustGridLayout(true);

            if (status === 'Disponible') {
                const tableCard = document.querySelector(`[onclick*="selectTable(${tableId},"]`);
                const waiterNameElement = tableCard.querySelector('.text-sm.text-gray-600');
                const waiterName = waiterNameElement ?
                    waiterNameElement.textContent.replace(/^\s*\S+\s*/, '').trim() :
                    '{{ Auth::user()->name }}';

                freeTablePanel.classList.remove('hidden');
                occupiedTablePanel.classList.add('hidden');
                document.getElementById('selectedTable').textContent = tableName;
                document.getElementById('peopleCount').max = capacity;
                document.getElementById('maxCapacity').textContent = capacity;
            } else {
                const tableCard = document.querySelector(`[onclick*="selectTable(${tableId},"]`);
                const waiterName = tableCard.querySelector('.text-sm.text-gray-600')?.textContent.trim() ||
                    '{{ Auth::user()->name }}';
                const totalElement = tableCard.querySelector('.text-sm.font-semibold.text-gray-800');
                const total = totalElement ? totalElement.textContent : 'S/. 0.00';

                // Limpiar la tabla de items
                const tbody = document.getElementById('orderItemsList');
                tbody.innerHTML = '';

                // Agregar console.log para debugging
                console.log('Table ID:', tableId);
                console.log('Status:', status);

                @foreach ($tables as $table)
                    if ({{ $table->id }} === tableId && '{{ $table->status->value }}' === 'Ocupado') {
                        console.log('Found matching table:', {{ $table->id }});
                        console.log('Order items:', {!! json_encode($table->orders->first()->orderItems) !!});

                        const orderItems = {!! json_encode($table->orders->first()->orderItems) !!};
                        orderItems.forEach(item => {
                            console.log('Processing item:', item);
                            const row = `
                                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                                        <td class="px-4 py-3 text-sm text-center text-gray-700 font-medium">
                                            ${item.quantity}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            ${item.menu_item ? item.menu_item.name : 'N/A'}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-right whitespace-nowrap font-medium text-gray-900">
                                            <span class="font-normal text-gray-500">S/.</span> ${parseFloat(item.price).toFixed(2)}
                                        </td>
                                    </tr>
                                `;
                            tbody.innerHTML += row;
                        });
                    }
                @endforeach

                freeTablePanel.classList.add('hidden');
                occupiedTablePanel.classList.remove('hidden');
                document.getElementById('tableInfo').textContent = tableName;
                document.getElementById('waiterInfo').textContent = waiterName;
                document.getElementById('totalAmount').textContent = total;
            }
        }

        function closeSidePanel() {
            const sidePanel = document.getElementById('sidePanel');
            sidePanel.classList.add('w-0');
            sidePanel.classList.remove('w-96');
            adjustGridLayout(false);
        }

        function increasePeopleCount() {
            const input = document.getElementById('peopleCount');
            if (parseInt(input.value) < parseInt(input.max)) {
                input.value = parseInt(input.value) + 1;
            }
        }

        function decreasePeopleCount() {
            const input = document.getElementById('peopleCount');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Eliminar la función loadTableData ya que no es necesaria

        function addNewOrder() {
            // Implementar redirección a la página de nuevo pedido
            // window.location.href = '/orders/create/' + tableId;
        }

        function processPayment() {
            // Implementar redirección a la página de cobro
            // window.location.href = '/orders/payment/' + tableId;
        }
    </script>
@stop
@section('style')
    <style>
        #sidePanel {
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .auto-rows-fr {
            grid-auto-rows: 1fr;
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
    </style>
@stop
