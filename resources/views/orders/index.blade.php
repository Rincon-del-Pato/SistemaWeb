@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
    <div class="px-2 pt-2 pb-4">
        <div class="flex justify-center space-x-3">
            <!-- Panel principal (contenedor de cards) -->
            <div id="mainPanel" class="flex-1 max-w-[1200px]">
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
                    <div class="grid grid-cols-2 gap-2 p-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6"
                        id="tablesGrid">
                        @foreach ($tables as $table)
                            <div class="relative shadow-md rounded-lg border-2 overflow-hidden
                                {{ $table->status->value === 'Disponible' ? 'border-green-600 bg-green-50' : 'border-red-600 bg-red-50' }}
                                cursor-pointer hover:shadow-xl transition-all duration-300"
                                onclick="selectTable({{ $table->id }}, {{ $table->seating_capacity }}, '{{ $table->table_number }}', '{{ $table->status->value }}')">

                                <div class="flex flex-col items-center p-1">
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
                <div class="bg-white shadow-lg w-96 rounded-xl max-h-[calc(100vh-100px)]">
                    <!-- Panel para mesa libre -->
                    <div id="freeTablePanel" class="hidden">
                        <div class="flex flex-col h-full">
                            <div class="p-3 border-b">
                                <h5 class="text-lg font-bold text-gray-800">Mesa: <span id="selectedTable">Ninguna</span>
                                </h5>
                            </div>
                            <div class="flex-1 p-3 overflow-y-auto">
                                <form id="capacityForm" action="{{ route('orders.create') }}" method="GET"
                                    class="space-y-4">
                                    <input type="hidden" name="table_id" id="selectedTableId">
                                    <input type="hidden" name="customer_count" id="customerCount">

                                    <!-- Número de personas -->
                                    <div>
                                        <label class="block mb-2 text-sm font-bold text-gray-700">Número de personas</label>
                                        <div class="relative w-full">
                                            <div
                                                class="flex items-center overflow-hidden border border-gray-300 rounded-lg">
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
                    </div>

                    <!-- Panel para mesa ocupada -->
                    <div id="occupiedTablePanel" class="hidden">
                        <div class="flex flex-col h-full">
                            <!-- Header con información -->
                            <div class="p-3 bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <i class="text-gray-600 fas fa-chair"></i>
                                        <span class="text-base font-bold">Mesa:</span>
                                        <span class="text-base font-bold text-blue-600" id="tableInfo"></span>
                                    </div>
                                    <div class="flex items-center gap-1 text-sm">
                                        <i class="text-gray-600 fas fa-user-tie"></i>
                                        <span class="font-medium text-gray-700" id="waiterInfo"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Lista de pedidos -->
                            <div class="flex-1 overflow-y-auto">
                                <div class="p-3">
                                    <h6 class="mb-2 text-sm font-bold text-gray-700">Pedidos de la mesa</h6>
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="w-16 px-2 py-1 text-xs font-semibold text-center text-gray-600">
                                                        Cant.</th>
                                                    <th class="px-2 py-1 text-xs font-semibold text-left text-gray-600">
                                                        Descripción</th>
                                                    <th class="w-20 px-2 py-1 text-xs font-semibold text-right text-gray-600">
                                                        Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody id="orderItemsList" class="divide-y divide-gray-100">
                                                <!-- Los items se cargarán dinámicamente aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Resumen y acciones -->
                            <div class="p-3 border-t bg-gray-50">
                                <div class="mb-3 text-center">
                                    <p class="text-xs text-gray-600">Total de la cuenta</p>
                                    <p class="text-xl font-bold text-gray-800" id="totalAmount">S/. 0.00</p>
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <button type="button" onclick="addNewOrder()"
                                        class="px-3 py-1.5 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        <i class="mr-1 fas fa-plus"></i>
                                        Agregar
                                    </button>
                                    <button type="button" onclick="processPayment()"
                                        class="px-3 py-1.5 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-700">
                                        <i class="mr-1 fas fa-cash-register"></i>
                                        Cobrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="currentTableId" value="">
            <input type="hidden" id="currentCustomerCount" value="">
        </div>
    </div>
@stop

@section('js')
    <script>
        function adjustGridLayout(isOpen) {
            const tablesGrid = document.getElementById('tablesGrid');
            if (isOpen) {
                tablesGrid.classList.remove('lg:grid-cols-4', 'xl:grid-cols-6');
                tablesGrid.classList.add('lg:grid-cols-3', 'xl:grid-cols-4');
            } else {
                tablesGrid.classList.remove('lg:grid-cols-3', 'xl:grid-cols-4');
                tablesGrid.classList.add('lg:grid-cols-4', 'xl:grid-cols-6');
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

                // Configurar los valores de los inputs hidden
                document.getElementById('selectedTableId').value = tableId;

                // Actualizar el customerCount cuando cambie el número de personas
                const peopleCountInput = document.getElementById('peopleCount');
                peopleCountInput.addEventListener('change', function() {
                    document.getElementById('customerCount').value = this.value;
                });
                // Establecer valor inicial
                document.getElementById('customerCount').value = peopleCountInput.value;

                // Asegurarse de que el formulario tenga los valores correctos antes de enviarlo
                document.getElementById('capacityForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const customerCount = document.getElementById('peopleCount').value;
                    window.location.href = `{{ route('orders.create') }}?table_id=${tableId}&customer_count=${customerCount}`;
                });
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
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm font-medium text-center text-gray-700">
                                            ${item.quantity}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            ${item.menu_item ? item.menu_item.name : 'N/A'}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-medium text-right text-gray-900 whitespace-nowrap">
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

                // Agregar el guardado del ID de la mesa y número de clientes
                document.getElementById('currentTableId').value = tableId;
                document.getElementById('currentCustomerCount').value =
                    document.querySelector(`[onclick*="selectTable(${tableId},"]`)
                    .querySelector('.fas.fa-users')
                    ?.nextElementSibling?.textContent || '0';
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
            const tableId = document.getElementById('currentTableId').value;
            const customerCount = document.getElementById('currentCustomerCount').value;

            if (!tableId) {
                alert('Error: No se ha seleccionado una mesa');
                return;
            }

            const url = new URL('{{ route('orders.create') }}');
            url.searchParams.append('table_id', tableId);
            url.searchParams.append('customer_count', customerCount);

            window.location.href = url.toString();
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

        /* Ajustes adicionales para pantallas pequeñas */
        @media (max-width: 1366px) {
            .grid {
                gap: 0.5rem !important;
            }

            .p-6 {
                padding: 1rem !important;
            }

            .text-lg {
                font-size: 0.9rem !important;
            }

            .w-12 {
                width: 2.5rem !important;
            }

            .h-12 {
                height: 2.5rem !important;
            }
        }

        /* Ajustes específicos para el panel lateral */
        @media (max-width: 1366px) {
            #sidePanel .text-lg {
                font-size: 0.875rem !important;
            }

            #sidePanel .text-base {
                font-size: 0.8125rem !important;
            }

            #sidePanel .text-sm {
                font-size: 0.75rem !important;
            }

            #sidePanel .text-xs {
                font-size: 0.6875rem !important;
            }

            #sidePanel .p-3 {
                padding: 0.75rem !important;
            }

            #sidePanel .gap-2 {
                gap: 0.375rem !important;
            }

            #sidePanel table td,
            #sidePanel table th {
                padding: 0.375rem 0.5rem !important;
            }
        }

        /* Ajustes para pantallas grandes */
        @media (min-width: 1680px) {
            #sidePanel {
                min-width: 400px;
            }

            #sidePanel .text-lg {
                font-size: 1.125rem !important;
            }

            #sidePanel .text-base {
                font-size: 1rem !important;
            }

            #sidePanel .text-sm {
                font-size: 0.875rem !important;
            }

            #sidePanel .text-xs {
                font-size: 0.75rem !important;

            }

            #sidePanel .p-3 {
                padding: 1rem !important;
            }

            #sidePanel table td,
            #sidePanel table th {
                padding: 0.5rem 0.75rem !iant;
            }

            .grid {
                gap: 1rem !important;
            }

            .p-6 {
                padding: 1.5rem !important;
            }

            .w-12 {
                width: 3rem !important;
            }

            .h-12 {
                height: 3rem !important;
            }
        }

        /* Ajustes para hover en pantallas grandes */
        @media (min-width: 1680px) {
            .hover\:shadow-xl:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
        }
    </style>
@stop
