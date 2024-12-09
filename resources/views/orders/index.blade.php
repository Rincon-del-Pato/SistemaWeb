@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
    <div class="px-2 pt-2 pb-4">
        <!-- Tabs de navegación -->
        <div class="mb-4 border-b border-gray-200">
            <div class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                <div class="mr-2">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-blue-600 text-blue-600 active group"
                        id="tabLocal" onclick="changeTab('Local')">
                        <i class="mr-2 fas fa-chair"></i>
                        Local
                    </button>
                </div>
                <div class="mr-2">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-transparent hover:border-gray-300 group"
                        id="tabParaLlevar" onclick="changeTab('ParaLlevar')">
                        <i class="mr-2 fas fa-shopping-bag"></i>
                        Para Llevar
                    </button>
                </div>
                <div>
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-transparent hover:border-gray-300 group"
                        id="tabDelivery" onclick="changeTab('Delivery')">
                        <i class="mr-2 fas fa-motorcycle"></i>
                        Delivery
                    </button>
                </div>
            </div>
        </div>

        <!-- Contenido de las tabs -->
        <div id="tabContentLocal" class="tabContent">
            <div class="flex justify-center space-x-3">
                <!-- Panel principal (contenedor de cards) -->
                <div id="mainPanel" class="flex-1">
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="p-3 border-b sm:p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex gap-2 sm:gap-3">
                                    <span
                                        class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-green-500 rounded-lg shadow-sm hover:bg-green-600">
                                        <i class="mr-1 sm:mr-2 fas fa-check-circle"></i>
                                        {{ $availableCount }} Libre
                                    </span>
                                    <span
                                        class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-red-500 rounded-lg shadow-sm hover:bg-red-600">
                                        <i class="mr-1 sm:mr-2 fas fa-times-circle"></i>
                                        {{ $occupiedCount }} Ocupado
                                    </span>
                                </div>
                                <button onclick="showReservationModal()" 
                                    class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-purple-500 rounded-lg shadow-sm hover:bg-purple-600">
                                    <i class="mr-1 sm:mr-2 fas fa-calendar-alt"></i>
                                    Nueva Reservación
                                </button>
                            </div>
                        </div>

                        <!-- Grid de mesas ajustado para diferentes pantallas -->
                        <div class="grid grid-cols-2 gap-2 p-2 sm:grid-cols-3 lg:grid-cols-5 2xl:grid-cols-6"
                            id="tablesGrid">
                            @foreach ($tables as $table)
                                <div class="relative border-2 rounded-lg overflow-hidden cursor-pointer transform transition-all duration-300 ease-in-out
                                    {{ $table->status->value === 'Disponible' ? 'border-green-600 bg-green-50' : 'border-red-600 bg-red-50' }}
                                    hover:shadow-lg hover:-translate-y-1"
                                    onclick="selectTable({{ $table->id }}, {{ $table->seating_capacity }}, '{{ $table->table_number }}', '{{ $table->status->value }}')">
                                    <div class="flex flex-col items-center p-2 sm:p-3 2xl:p-4">
                                        <h4 class="text-base font-bold text-gray-800 sm:text-lg 2xl:text-xl">
                                            {{ $table->table_number }}</h4>
                                        @if ($table->status->value === 'Ocupado' && $table->orders->isNotEmpty())
                                            @php
                                                $currentOrder = $table->orders->first();
                                                $created = new DateTime($currentOrder->created_at);
                                                $now = new DateTime();
                                                $interval = $created->diff($now);
                                                $timeDisplay =
                                                    $interval->h > 0
                                                        ? $interval->h . 'h ' . $interval->i . 'm'
                                                        : $interval->i . ' min';
                                            @endphp
                                            <p class="text-sm text-gray-600 sm:text-base 2xl:text-2xl">
                                                <i class="mr-1 fas fa-user-tie"></i>
                                                {{ $currentOrder->user->name ?? 'N/A' }}
                                            </p>
                                            <img src="{{ asset('imagen/mesa-llena.png') }}"
                                                class="w-8 h-8 my-2 sm:w-10 sm:h-10">
                                            <div
                                                class="flex items-center justify-between gap-2 text-sm text-gray-600 sm:text-base 2xl:text-xl">
                                                <span>{{ $timeDisplay }}</span>
                                            </div>
                                            <div class="text-sm font-semibold text-gray-800 sm:text-base 2xl:text-xl">
                                                Total: S/. {{ number_format($currentOrder->total, 2) }}
                                            </div>
                                        @else
                                            <img src="{{ asset('imagen/mesa-vacia.png') }}"
                                                class="w-8 h-8 my-2 sm:w-10 sm:h-10 2xl:w-14 2xl:h-14">
                                            <div class="flex flex-col items-center gap-1 text-green-600">
                                                <i class="text-base sm:text-lg 2xl:text-xl fas fa-check-circle"></i>
                                                <span class="text-xs font-semibold sm:text-sm 2xl:text-base">Libre</span>
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
                                    <h5 class="text-lg font-bold text-gray-800">Mesa: <span
                                            id="selectedTable">Ninguna</span>
                                    </h5>
                                </div>
                                <div class="flex-1 p-3 overflow-y-auto">
                                    <form id="capacityForm" action="{{ route('orders.create') }}" method="GET"
                                        class="space-y-4">
                                        <input type="hidden" name="table_id" id="selectedTableId">
                                        <input type="hidden" name="customer_count" id="customerCount">

                                        <!-- Número de personas -->
                                        <div>
                                            <label class="block mb-2 text-sm font-bold text-gray-700">Número de
                                                personas</label>
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
                                                        <th
                                                            class="w-16 px-2 py-1 text-xs font-semibold text-center text-gray-600">
                                                            Cant.</th>
                                                        <th
                                                            class="px-2 py-1 text-xs font-semibold text-left text-gray-600">
                                                            Descripción</th>
                                                        <th
                                                            class="w-20 px-2 py-1 text-xs font-semibold text-right text-gray-600">
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
                                            class="px-3 py-1.5 text-sm font-bold text-white bg-red-500 rounded-lg hover:bg-red-600">
                                            <i class="fas fa-arrow-right"></i> Agregar Pedido
                                        </button>
                                        <button type="button" onclick="cancelOrder()"
                                            class="px-3 py-1.5 text-sm font-bold text-white bg-gray-700 rounded-lg hover:bg-gray-800">
                                            <i class="fas fa-times"></i> Anular Pedido
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 mt-2">
                                        <button type="button" onclick="generatePreBill()"
                                            class="px-3 py-1.5 text-sm font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                            <i class="fas fa-print"></i> Pre Cuenta
                                        </button>
                                        <button type="button" onclick="changeTable()"
                                            class="px-3 py-1.5 text-sm font-bold text-white bg-indigo-500 rounded-lg hover:bg-indigo-600">
                                            <i class="fas fa-exchange-alt"></i> Cambiar Mesa
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 mt-2">
                                        <button type="button" onclick="processPayment()"
                                            class="px-3 py-1.5 text-sm font-bold text-white bg-green-500 rounded-lg hover:bg-green-600">
                                            <i class="fas fa-cash-register"></i> Cobrar Imprimir
                                        </button>
                                        <button type="button" onclick="closeSidePanel()"
                                            class="px-3 py-1.5 text-sm font-bold text-white bg-gray-600 rounded-lg hover:bg-gray-700">
                                            <i class="fas fa-times"></i> Cancelar
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

        <!-- Reemplazar la sección de Para Llevar -->
        <div id="tabContentParaLlevar" class="tabContent hidden">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Órdenes Para Llevar</h3>
                        <button onclick="createTakeAwayOrder()"
                            class="px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            <i class="mr-2 fas fa-plus"></i>Nueva Orden
                        </button>
                    </div>

                    <!-- Sub-tabs para estados Para Llevar -->
                    <div class="mb-4 border-b border-gray-200">
                        <div class="flex flex-wrap -mb-px text-sm font-medium text-center">
                            @foreach (['Pendiente', 'Preparando', 'Completado'] as $estado)
                                <button type="button"
                                    class="mr-2 inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 group
                                        {{ $loop->first ? 'border-yellow-600 text-yellow-600' : 'border-transparent' }}"
                                    id="tabParaLlevar{{ $estado }}"
                                    onclick="changeTakeAwayTab('{{ $estado }}')">
                                    <span
                                        class="mr-2 px-2 py-1 text-xs rounded-full 
                                        {{ $estado === 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $estado === 'Preparando' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $estado === 'Completado' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $paraLlevarOrders[$estado]->count() }}
                                    </span>
                                    {{ $estado }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Contenido de cada estado -->
                    @foreach (['Pendiente', 'Preparando', 'Completado'] as $estado)
                        <div id="contentParaLlevar{{ $estado }}"
                            class="tabContentParaLlevar {{ !$loop->first ? 'hidden' : '' }}">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Pedido #</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Tiempo</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Cliente</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Total</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($paraLlevarOrders[$estado] as $order)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $order->id }}</td>
                                                <td class="px-4 py-2">
                                                    {{ $order->created_at->diffForHumans() }}
                                                    <br>
                                                    <span class="text-xs text-gray-500">
                                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2">
                                                    {{ $order->customer ? $order->customer->name : 'Cliente General' }}
                                                </td>
                                                <td class="px-4 py-2 font-medium">
                                                    S/. {{ number_format($order->total, 2) }}
                                                </td>
                                                <td class="px-4 py-2">

                                                    <button onclick="printInvoice({{ $order->id }})"
                                                        class="text-green-600 hover:text-green-800">
                                                        <i class="fas fa-print"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                    No hay órdenes en estado {{ $estado }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Modal para ver detalles de la orden -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalles del Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="orderDetailsContent">
                        <!-- El contenido se cargará dinámicamente -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="printOrder()">Imprimir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reemplazar la sección de Delivery -->
        <div id="tabContentDelivery" class="tabContent hidden">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Órdenes Delivery</h3>
                        <button onclick="createDeliveryOrder()"
                            class="px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            <i class="mr-2 fas fa-plus"></i>Nueva Orden
                        </button>
                    </div>

                    <!-- Sub-tabs para estados Delivery -->
                    <div class="mb-4 border-b border-gray-200">
                        <div class="flex flex-wrap -mb-px text-sm font-medium text-center">
                            @foreach (['Pendiente', 'Preparando', 'Enviando', 'Completado'] as $estado)
                                <button type="button"
                                    class="mr-2 inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 group
                                        {{ $loop->first ? 'border-yellow-600 text-yellow-600' : 'border-transparent' }}"
                                    id="tabDelivery{{ $estado }}"
                                    onclick="changeDeliveryTab('{{ $estado }}')">
                                    <span
                                        class="mr-2 px-2 py-1 text-xs rounded-full 
                                        {{ $estado === 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $estado === 'Preparando' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $estado === 'Enviando' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $estado === 'Completado' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $deliveryOrders[$estado]->count() }}
                                    </span>
                                    {{ $estado }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Contenido de cada estado -->
                    @foreach (['Pendiente', 'Preparando', 'Enviando', 'Completado'] as $estado)
                        <div id="contentDelivery{{ $estado }}"
                            class="tabContentDelivery {{ !$loop->first ? 'hidden' : '' }}">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Pedido #</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Cliente</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Dirección</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Tiempo</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Total</th>
                                            <th class="px-4 py-2 text-xs font-medium text-gray-500">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($deliveryOrders[$estado] as $order)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">#{{ $order->id }}</td>
                                                <td class="px-4 py-2">{{ $order->customer->name }}</td>
                                                <td class="px-4 py-2">{{ $order->delivery_address }}</td>
                                                <td class="px-4 py-2">
                                                    {{ $order->created_at->diffForHumans() }}
                                                    <br>
                                                    <span class="text-xs text-gray-500">
                                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2 font-medium">
                                                    S/. {{ number_format($order->total, 2) }}
                                                </td>
                                                <td class="px-4 py-2">
                                                    <div class="flex space-x-2">
                                                        @if($estado !== 'Completado')
                                                            <button onclick="showDeliveryDetails({{ $order->id }})"
                                                                class="text-blue-600 hover:text-blue-800">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button onclick="printInvoice({{ $order->id }})"
                                                                class="text-green-600 hover:text-green-800">
                                                                <i class="fas fa-print"></i>
                                                            </button>
                                                        @else
                                                            <button onclick="printInvoice({{ $order->id }})"
                                                                class="text-green-600 hover:text-green-800">
                                                                <i class="fas fa-print"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                                    No hay órdenes en estado {{ $estado }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
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
                    window.location.href =
                        `{{ route('orders.create') }}?table_id=${tableId}&customer_count=${customerCount}`;
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

                // Modificar esta parte para manejar casos nulos
                @foreach ($tables as $table)
                    if ({{ $table->id }} === tableId && '{{ $table->status->value }}' === 'Ocupado') {
                        @if ($table->orders && $table->orders->isNotEmpty() && $table->orders->first()->orderItems)
                            const orderItems = {!! json_encode($table->orders->first()->orderItems) !!};
                            orderItems.forEach(item => {
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
                        @else
                            tbody.innerHTML = `
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-sm text-center text-gray-500">
                                        No hay items en esta orden
                                    </td>
                                </tr>
                            `;
                        @endif
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
                    @if ($table->orders->isNotEmpty())
                        const orderId = {{ $table->orders->first()->id }};
                        window.location.href = '{{ url('/orders') }}/' + orderId + '/edit';
                        return;
                    @endif
                }
            @endforeach

            // Si no hay orden existente, crear una nueva
            const customerCount = document.getElementById('currentCustomerCount').value || 1;
            window.location.href = `{{ route('orders.create') }}?table_id=${tableId}&customer_count=${customerCount}`;
        }

        function cancelOrder() {
            const tableId = document.getElementById('currentTableId').value;
            if (!tableId) {
                alert('Por favor, seleccione una mesa primero');
                return;
            }

            if (confirm('¿Está seguro de anular este pedido?')) {
                @foreach ($tables as $table)
                    if ({{ $table->id }} === parseInt(tableId) && '{{ $table->status->value }}' === 'Ocupado') {
                        @if ($table->orders->isNotEmpty())
                            const orderId = {{ $table->orders->first()->id }};
                            window.location.href = '{{ url('/orders') }}/' + orderId + '/cancel';
                            return;
                        @endif
                    }
                @endforeach
            }
        }

        function generatePreBill() {
            const tableId = document.getElementById('currentTableId').value;
            if (!tableId) {
                alert('Por favor, seleccione una mesa primero');
                return;
            }

            @foreach ($tables as $table)
                if ({{ $table->id }} === parseInt(tableId) && '{{ $table->status->value }}' === 'Ocupado') {
                    @if ($table->orders->isNotEmpty())
                        const orderId = {{ $table->orders->first()->id }};
                        window.open('{{ url('/orders') }}/' + orderId + '/pre-bill', '_blank');
                        return;
                    @endif
                }
            @endforeach
        }

        function changeTable() {
            const tableId = document.getElementById('currentTableId').value;
            if (!tableId) {
                alert('Por favor, seleccione una mesa primero');
                return;
            }

            // Implementar lógica para mostrar modal de cambio de mesa
            // Aquí puedes usar SweetAlert2 o tu propio modal
            Swal.fire({
                title: 'Cambiar Mesa',
                html: `
                    <select id="newTableId" class="swal2-input">
                        @foreach ($tables as $table)
                            @if ($table->status->value === 'Disponible')
                                <option value="{{ $table->id }}">{{ $table->table_number }}</option>
                            @endif
                        @endforeach
                    </select>
                `,
                showCancelButton: true,
                confirmButtonText: 'Cambiar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const newTableId = document.getElementById('newTableId').value;
                    if (!newTableId) {
                        Swal.showValidationMessage('Seleccione una mesa destino');
                    }
                    return {
                        newTableId
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hacer la petición para cambiar de mesa
                    fetch(`/orders/change-table`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                currentTableId: tableId,
                                newTableId: result.value.newTableId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        });
                }
            });
        }

        function processPayment() {
            const tableId = document.getElementById('currentTableId').value;
            if (!tableId) {
                alert('Por favor, seleccione una mesa primero');
                return;
            }

            @foreach ($tables as $table)
                if ({{ $table->id }} === parseInt(tableId) && '{{ $table->status->value }}' === 'Ocupado') {
                    @if ($table->orders->isNotEmpty())
                        const orderId = {{ $table->orders->first()->id }};
                        window.location.href = '{{ url('/orders') }}/' + orderId + '/payment';
                        return;
                    @endif
                }
            @endforeach
        }

        function changeTab(tabName) {
            // Ocultar todos los contenidos
            document.querySelectorAll('.tabContent').forEach(content => {
                content.classList.add('hidden');
            });

            // Mostrar el contenido seleccionado
            document.getElementById(`tabContent${tabName}`).classList.remove('hidden');

            // Actualizar estilos de las pestañas
            document.querySelectorAll('[id^="tab"]').forEach(tab => {
                tab.classList.remove('border-blue-600', 'text-blue-600');
                tab.classList.add('border-transparent');
            });

            // Activar la pestaña seleccionada
            const activeTab = document.getElementById(`tab${tabName}`);
            activeTab.classList.remove('border-transparent');
            activeTab.classList.add('border-blue-600', 'text-blue-600');
        }

        function createTakeAwayOrder() {
            window.location.href = "{{ route('orders.create') }}?type=ParaLlevar";
        }

        function createDeliveryOrder() {
            window.location.href = "{{ route('orders.create') }}?type=Delivery";
        }

        function updateOrderStatus(orderId, currentStatus) {
            let nextStatus;
            switch (currentStatus) {
                case 'Pendiente':
                    nextStatus = 'Preparando';
                    break;
                case 'Preparando':
                    nextStatus = window.location.href.includes('Delivery') ? 'Enviando' : 'Completado';
                    break;
                case 'Enviando':
                    nextStatus = 'Completado';
                    break;
                default:
                    return;
            }

            fetch(`/orders/${orderId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: nextStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Error al actualizar el estado');
                    }
                });
        }

        function changeTakeAwayTab(estado) {
            // Ocultar todos los contenidos
            document.querySelectorAll('.tabContentParaLlevar').forEach(content => {
                content.classList.add('hidden');
            });

            // Mostrar el contenido seleccionado
            document.getElementById(`contentParaLlevar${estado}`).classList.remove('hidden');

            // Actualizar estilos de las pestañas
            document.querySelectorAll('[id^="tabParaLlevar"]').forEach(tab => {
                tab.classList.remove('border-yellow-600', 'text-yellow-600');
                tab.classList.add('border-transparent');
            });

            // Activar la pestaña seleccionada
            const activeTab = document.getElementById(`tabParaLlevar${estado}`);
            activeTab.classList.remove('border-transparent');
            activeTab.classList.add('border-yellow-600', 'text-yellow-600');
        }

        function changeDeliveryTab(estado) {
            // Ocultar todos los contenidos
            document.querySelectorAll('.tabContentDelivery').forEach(content => {
                content.classList.add('hidden');
            });

            // Mostrar el contenido seleccionado
            document.getElementById(`contentDelivery${estado}`).classList.remove('hidden');

            // Actualizar estilos de las pestañas
            document.querySelectorAll('[id^="tabDelivery"]').forEach(tab => {
                tab.classList.remove('border-yellow-600', 'text-yellow-600');
                tab.classList.add('border-transparent');
            });

            // Activar la pestaña seleccionada
            const activeTab = document.getElementById(`tabDelivery${estado}`);
            activeTab.classList.remove('border-transparent');
            activeTab.classList.add('border-yellow-600', 'text-yellow-600');
        }

        let currentOrderId = null;

        function showOrderDetails(orderId) {
            currentOrderId = orderId;
            $.ajax({ // Cambiado a jQuery ajax para mayor compatibilidad
                url: `/orders/${orderId}/details`,
                method: 'GET',
                success: function(response) {
                    let html = `
                        <div class="p-3">
                            <div class="mb-4 bg-light rounded p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="mb-1">Pedido #${response.id}</p>
                                        <p class="mb-1">Fecha: ${moment(response.created_at).format('DD/MM/YYYY HH:mm')}</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <p class="mb-1">Mozo: ${response.user.name}</p>
                                    </div>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Cant.</th>
                                        <th>Producto</th>
                                        <th class="text-right">P.U.</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${response.order_items.map(item => `
                                            <tr>
                                                <td class="text-center">${item.quantity}</td>
                                                <td>${item.menu_item.name}</td>
                                                <td class="text-right">S/. ${parseFloat(item.price).toFixed(2)}</td>
                                                <td class="text-right">S/. ${(item.quantity * item.price).toFixed(2)}</td>
                                            </tr>
                                        `).join('')}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                        <td class="text-right"><strong>S/. ${parseFloat(response.total).toFixed(2)}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    `;

                    $('#orderDetailsContent').html(html);
                    $('#orderDetailsModal').modal('show');
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudieron cargar los detalles del pedido'
                    });
                }
            });
        }

        function printOrder() {
            if (currentOrderId) {
                window.open(`/orders/${currentOrderId}/pre-bill`, '_blank');
            }
        }

        function printInvoice(orderId) { // Nueva función
            window.open(`/orders/${orderId}/invoice`, '_blank');
        }

        function showReservationModal() {
            const modal = document.getElementById('reservationModal');
            const backdrop = document.createElement('div');
            backdrop.className = 'fixed inset-0 bg-black/30 z-[40]'; // Reducida la opacidad y z-index
            backdrop.id = 'modal-backdrop';
            document.body.appendChild(backdrop);
            modal.classList.remove('hidden');
            
            // Establecer fecha mínima
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('reservation_time').min = minDateTime;
        }

        function closeReservationModal() {
            const modal = document.getElementById('reservationModal');
            const backdrop = document.getElementById('modal-backdrop');
            modal.classList.add('hidden');
            if (backdrop) {
                backdrop.remove();
            }
        }

        function submitReservation() {
            const form = document.getElementById('reservationForm');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Reservación creada',
                        text: 'La reservación se ha guardado correctamente',
                        confirmButtonColor: '#3B82F6'
                    }).then(() => {
                        closeReservationModal();
                        form.reset();
                        // Opcional: recargar la página para actualizar las mesas
                        // window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Ha ocurrido un error al crear la reservación',
                        confirmButtonColor: '#EF4444'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error al procesar la reservación',
                    confirmButtonColor: '#EF4444'
                });
            });
        }

        // Agregar manejador de F1
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
            }
        });
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

            #tablesGrid>div {
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

            #tablesGrid>div {
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
            .w-8,
            .h-8,
            .w-10,
            .h-10 {
                width: 2.5rem;
                height: 2.5rem;
            }

            /* Ajustes específicos para la información de mesa ocupada */
            #tablesGrid .text-gray-600 {
                font-size: 1.25rem;
                /* Aumentado */
            }

            #tablesGrid .font-semibold.text-gray-800 {
                font-size: 1.3rem;
                /* Aumentado */
                margin-top: 0.5rem;
            }

            /* Ajuste para el tiempo y total */
            #tablesGrid .flex.items-center.justify-between span {
                font-size: 1.25rem;
                /* Aumentado */
            }

            /* Ajuste para el nombre del mozo */
            #tablesGrid p.text-xs.sm\:text-sm.2xl\:text-base {
                font-size: 1.2rem;
                /* Aumentado */
                margin: 0.5rem 0;
                /* Espaciado adicional */
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

        #tablesGrid>div {
            animation: fadeIn 0.3s ease-out forwards;
        }

        #tablesGrid>div:nth-child(n) {
            animation-delay: calc(n * 0.05s);
        }

        /* Estilos para el modal */
        #reservationModal {
            backdrop-filter: blur(2px);
        }

        #modal-backdrop {
            transition: opacity 0.3s ease-in-out;
        }

        .modal-open {
            overflow: hidden;
        }
    </style>
@stop

<!-- Reemplazar el modal existente con este nuevo diseño -->
<div id="reservationModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-transparent flex items-center justify-center">
    <div class="relative w-full max-w-md">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900">
                    Nueva Reservación
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    onclick="closeReservationModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6">
                <form id="reservationForm" action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="customer_name" class="block mb-2 text-sm font-medium text-gray-900">Nombre del Cliente</label>
                        <input type="text" id="customer_name" name="customer_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    
                    <div>
                        <label for="customer_phone" class="block mb-2 text-sm font-medium text-gray-900">Teléfono</label>
                        <input type="text" id="customer_phone" name="customer_phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label for="table_id" class="block mb-2 text-sm font-medium text-gray-900">Mesa</label>
                        <select id="table_id" name="table_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="">Seleccione una mesa</option>
                            @foreach($tables as $table)
                                @if($table->status->value === 'Disponible')
                                    <option value="{{ $table->id }}">Mesa {{ $table->table_number }} ({{ $table->seating_capacity }} personas)</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="num_guests" class="block mb-2 text-sm font-medium text-gray-900">Número de Personas</label>
                        <input type="number" id="num_guests" name="num_guests" min="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    <div>
                        <label for="reservation_time" class="block mb-2 text-sm font-medium text-gray-900">Fecha y Hora</label>
                        <input type="datetime-local" id="reservation_time" name="reservation_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                <button type="button" onclick="submitReservation()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Guardar</button>
                <button type="button" onclick="closeReservationModal()" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancelar</button>
            </div>
        </div>
    </div>
</div>
