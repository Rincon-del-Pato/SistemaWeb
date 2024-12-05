@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
    <div class="px-2 pt-2 pb-4">
        <div class="flex justify-center space-x-3">
            <!-- Panel principal (contenedor de cards) -->
            <div id="mainPanel" class="flex-1">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-3 sm:p-4 border-b">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2 sm:gap-3">
                                <span class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-green-500 rounded-lg shadow-sm hover:bg-green-600">
                                    <i class="mr-1 sm:mr-2 fas fa-check-circle"></i>
                                    {{ $availableCount }} Libre
                                </span>
                                <span class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-red-500 rounded-lg shadow-sm hover:bg-red-600">
                                    <i class="mr-1 sm:mr-2 fas fa-times-circle"></i>
                                    {{ $occupiedCount }} Ocupado
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de mesas ajustado para diferentes pantallas -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 2xl:grid-cols-6 gap-2 p-2"
                        id="tablesGrid">
                        @foreach ($tables as $table)
                            <div class="relative border-2 rounded-lg overflow-hidden cursor-pointer transform transition-all duration-300 ease-in-out
                                {{ $table->status->value === 'Disponible' ? 'border-green-600 bg-green-50' : 'border-red-600 bg-red-50' }}
                                hover:shadow-lg hover:-translate-y-1"
                                onclick="selectTable({{ $table->id }}, {{ $table->seating_capacity }}, '{{ $table->table_number }}', '{{ $table->status->value }}')">
                                <div class="flex flex-col items-center p-2 sm:p-3 2xl:p-4">
                                    <h4 class="text-base sm:text-lg 2xl:text-xl font-bold text-gray-800">{{ $table->table_number }}</h4>
                                    @if ($table->status->value === 'Ocupado')
                                        <p class="text-sm sm:text-base 2xl:text-2xl text-gray-600">
                                            <i class="mr-1 fas fa-user-tie"></i>
                                            {{ $table->waiterName }}
                                        </p>
                                        <img src="{{ asset('imagen/mesa-llena.png') }}" class="w-8 h-8 sm:w-10 sm:h-10 my-2">
                                        <div class="flex items-center justify-between gap-2 text-sm sm:text-base 2xl:text-xl text-gray-600">
                                            @php
                                                $created = new DateTime($table->orders->first()->created_at);
                                                $now = new DateTime();
                                                $interval = $created->diff($now);
                                                $timeDisplay = $interval->h > 0
                                                    ? $interval->h . 'h ' . $interval->i . 'm'
                                                    : $interval->i . ' min';
                                            @endphp
                                            <span>{{ $timeDisplay }}</span>
                                        </div>
                                        <div class="text-sm sm:text-base 2xl:text-xl font-semibold text-gray-800">
                                            Total: S/. {{ number_format($table->orders->first()->total, 2) }}
                                        </div>
                                    @else
                                        <img src="{{ asset('imagen/mesa-vacia.png') }}" class="w-8 h-8 sm:w-10 sm:h-10 2xl:w-14 2xl:h-14 my-2">
                                        <div class="flex flex-col items-center gap-1 text-green-600">
                                            <i class="text-base sm:text-lg 2xl:text-xl fas fa-check-circle"></i>
                                            <span class="text-xs sm:text-sm 2xl:text-base font-semibold">Libre</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Panel lateral -->
            <div id="sidePanel" class="w-0 overflow-hidden transition-all duration-300">
                <div class="bg-white rounded-lg shadow-sm w-80 sm:w-96">
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
                                                    class="flex-1 py-1 text-lg font-medium text-center border-none focus:outline-none focus:ring-0">
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
            if (!tableId) {
                alert('Por favor, seleccione una mesa primero');
                return;
            }

            // Obtener el ID de la orden actual de la mesa
            @foreach ($tables as $table)
                if ({{ $table->id }} === parseInt(tableId) && '{{ $table->status->value }}' === 'Ocupado') {
                    const orderId = {{ $table->orders->first()->id ?? 'null' }};
                    if (orderId) {
                        window.location.href = `{{ url('orders') }}/${orderId}/edit`;
                        return;
                    }
                }
            @endforeach

            // Si no hay orden existente, crear una nueva
            const customerCount = document.getElementById('currentCustomerCount').value || 1;
            window.location.href = `{{ route('orders.create') }}?table_id=${tableId}&customer_count=${customerCount}`;
        }

        function processPayment() {
            // Implementar redirección a la página de cobro
            // window.location.href = '/orders/payment/' + tableId;
        }
    </script>
@stop

@section('style')
    <style>
        /* Estilos base */
        #sidePanel {
            transition: width 0.3s ease;
        }

        /* Ajustes para 1366x768 */
        @media (min-width: 1024px) and (max-width: 1366px) {
            .grid {
                gap: 0.5rem;
            }

            #tablesGrid > div {
                min-height: 140px;
            }

            #sidePanel {
                width: 320px;
            }

            .text-lg {
                font-size: 0.875rem;
            }

            .text-base {
                font-size: 0.8125rem;
            }

            .text-sm {
                font-size: 0.75rem;
            }
        }

        /* Ajustes para 1682x913 - Solo modificamos tamaños de texto */
        @media (min-width: 1600px) {
            .grid {
                gap: 1rem;
            }

            #tablesGrid > div {
                min-height: 180px;
            }

            /* Ajustes específicos de texto */
            .text-xl {
                font-size: 1.5rem;
            }

            .text-lg {
                font-size: 1.25rem;
            }

            .text-base {
                font-size: 1.125rem;
            }

            .text-sm {
                font-size: 1rem;
            }

            .text-xs {
                font-size: 0.875rem;
            }

            /* Ajustes para textos específicos */
            #tablesGrid .font-bold {
                font-size: 1.35rem;
            }

            #tablesGrid .text-gray-600 {
                font-size: 1.1rem;
            }

            #tablesGrid .font-semibold {
                font-size: 1.15rem;
            }

            /* Mantener tamaños de imágenes */
            .w-8, .h-8, .w-10, .h-10 {
                width: 2.5rem;
                height: 2.5rem;
            }

            /* Ajustes específicos para la información de mesa ocupada */
            #tablesGrid .text-gray-600 {
                font-size: 1.25rem;  /* Aumentado */
            }

            #tablesGrid .font-semibold.text-gray-800 {
                font-size: 1.3rem;   /* Aumentado */
                margin-top: 0.5rem;
            }

            /* Ajuste para el tiempo y total */
            #tablesGrid .flex.items-center.justify-between span {
                font-size: 1.25rem;  /* Aumentado */
            }

            /* Ajuste para el nombre del mozo */
            #tablesGrid p.text-xs.sm\:text-sm.2xl\:text-base {
                font-size: 1.2rem;   /* Aumentado */
                margin: 0.5rem 0;    /* Espaciado adicional */
            }
        }

        /* Transiciones suaves */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Mejora de hover */
        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Animación al cargar */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #tablesGrid > div {
            animation: fadeIn 0.3s ease-out forwards;
        }

        #tablesGrid > div:nth-child(n) {
            animation-delay: calc(n * 0.05s);
        }
    </style>
@stop
