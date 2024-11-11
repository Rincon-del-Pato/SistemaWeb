@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
    <div class="pt-2 px-4 pb-4">
        <div class="flex space-x-4">
            <!-- Panel principal (contenedor de cards) -->
            <div id="mainPanel" class="flex-1 transition-all duration-300 ease-in-out">
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="p-6 border-b">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-3">
                                <span class="px-4 py-2 text-sm font-semibold text-white bg-green-500 rounded-lg shadow-sm hover:bg-green-600 transition-all">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    {{ $tables->where('status', 'Disponible')->count() }} Libre
                                </span>
                                <span class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-lg shadow-sm hover:bg-red-600 transition-all">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    {{ $tables->where('status', 'Ocupado')->count() }} Ocupado
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 auto-rows-fr">
                            @foreach ($tables as $table)
                                <div class="transform transition-all duration-300 hover:scale-105">
                                    <div class="relative w-full h-full rounded-xl shadow-md border-2 overflow-hidden
                                        {{ $table->status->value === 'Disponible'
                                            ? 'border-green-400 bg-gradient-to-br from-green-50 to-green-100 hover:shadow-lg cursor-pointer'
                                            : ($table->status->value === 'Ocupado'
                                                ? 'border-red-400 bg-gradient-to-br from-red-50 to-red-100 cursor-pointer'
                                                : 'border-yellow-400 bg-gradient-to-br from-yellow-50 to-yellow-100') }}"
                                        onclick="selectTable({{ $table->id }}, {{ $table->capacity }}, '{{ $table->name }}', '{{ $table->status->value }}')">
                                        <div class="p-4 flex flex-col items-center">
                                            <!-- Estado como badge en la esquina superior -->
                                            <div class="absolute top-2 right-2">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $table->status->value === 'Disponible'
                                                        ? 'bg-green-500 text-white'
                                                        : ($table->status->value === 'Ocupado'
                                                            ? 'bg-red-500 text-white'
                                                            : 'bg-yellow-500 text-white') }}">
                                                    {{ $table->status->value }}
                                                </span>
                                            </div>

                                            <h6 class="font-bold text-xl mb-2 text-gray-800">{{ $table->name }}</h6>

                                            @if ($table->status->value !== 'Disponible' && $table->personal_id)
                                                <div class="flex items-center gap-1 text-gray-600 mb-2">
                                                    <i class="fas fa-user text-sm"></i>
                                                    <span class="text-sm">{{ $table->personal->name }}</span>
                                                </div>
                                            @endif

                                            <div class="relative group">
                                                <img src="{{ asset(
                                                    $table->status->value === 'Disponible'
                                                        ? 'imagen/mesa-vacia.png'
                                                        : ($table->status->value === 'Ocupado'
                                                            ? 'imagen/mesa-llena.png'
                                                            : 'imagen/mesa-reservada.png')
                                                ) }}"
                                                    alt="Mesa"
                                                    class="w-24 h-24 object-contain transition-transform duration-300 group-hover:scale-110">
                                            </div>

                                            <div class="flex items-center gap-2 mt-2 text-gray-600">
                                                <i class="fas fa-users"></i>
                                                <span class="font-medium">{{ $table->capacity }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel lateral (formulario) -->
            <div id="sidePanel" class="w-0 transition-all duration-300 ease-in-out overflow-hidden">
                <div class="w-96 bg-white rounded-xl shadow-lg">
                    <div class="p-4 border-b">
                        <h5 class="font-bold text-xl text-gray-800">
                            <span id="selectedTable" class="text-blue-600">Ninguna</span>
                        </h5>
                    </div>

                    <!-- Vista para mesa disponible -->
                    <div id="availableView" class="pb-4 px-4 hidden">
                        <form id="capacityForm" class="space-y-4">
                            <input type="hidden" id="tableId">
                            <div>
                                <label for="peopleCount" class="block text-sm font-medium text-gray-700 mb-1">
                                    Número de personas
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-users text-gray-400"></i>
                                    </div>
                                    <input type="number"
                                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="peopleCount"
                                        min="1"
                                        required>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Capacidad máxima: <span id="maxCapacity" class="font-medium"></span></p>
                            </div>
                            <div class="flex gap-4">
                                <button type="submit"
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                                    <i class="fas fa-check"></i>
                                    <span>Confirmar</span>
                                </button>
                                <button type="button"
                                    class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
                                    onclick="closeSidePanel()">
                                    <i class="fas fa-times"></i>
                                    <span>Cancelar</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Vista para mesa ocupada -->
                    <div id="occupiedView" class="pb-4 px-4 hidden">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2 text-gray-600 border-b pb-2">
                                <i class="fas fa-user"></i>
                                <span id="waiterName"></span>
                            </div>
                            <div class="max-h-[400px] overflow-y-auto hide-scrollbar">
                                <div id="orderItems" class="space-y-2"></div>
                            </div>
                            <div class="border-t pt-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total:</span>
                                    <span class="text-xl font-bold text-blue-600" id="orderTotal"></span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="closeSidePanel()"
                                    class="bg-gray-600 text-white rounded-lg px-4 py-2 hover:bg-gray-700 w-full">
                                    <i class="fas fa-times"></i> Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script>
function selectTable(tableId, capacity, tableName, status) {
    const sidePanel = document.getElementById('sidePanel');
    const availableView = document.getElementById('availableView');
    const occupiedView = document.getElementById('occupiedView');

    // Mostrar el panel lateral
    sidePanel.classList.remove('w-0');
    sidePanel.classList.add('w-96');
    
    document.getElementById('selectedTable').textContent = tableName;

    if (status === 'Disponible') {
        // Mostrar vista de mesa disponible
        availableView.classList.remove('hidden');
        occupiedView.classList.add('hidden');
        
        // Configurar formulario
        document.getElementById('tableId').value = tableId;
        document.getElementById('maxCapacity').textContent = capacity;
        document.getElementById('peopleCount').max = capacity;
        document.getElementById('peopleCount').value = '1'; // Valor por defecto
    } else if (status === 'Ocupado') {
        // Mostrar vista de mesa ocupada
        availableView.classList.add('hidden');
        occupiedView.classList.remove('hidden');

        // Obtener detalles de la orden actual
        const tableElement = document.querySelector(`[onclick*="selectTable(${tableId},"]`);
        const waiterName = tableElement.querySelector('.text-sm')?.textContent || 'No asignado';
        document.getElementById('waiterName').textContent = waiterName;

        // Aquí puedes agregar la lógica para mostrar los items de la orden
        // Por ahora mostraremos un mensaje temporal
        document.getElementById('orderItems').innerHTML = `
            <div class="p-4 text-center text-gray-500">
                <i class="fas fa-receipt text-4xl mb-2"></i>
                <p>Mesa ocupada por ${waiterName}</p>
            </div>
        `;
        document.getElementById('orderTotal').textContent = 'S/ 0.00';
    }
}

// ...rest of existing code...
</script>
    @stop

    <style>
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }

        @keyframes slideOut {
            from { transform: translateX(0); }
            to { transform: translateX(100%); }
        }

        /* Asegurar que las cards mantengan proporciones consistentes */
        .auto-rows-fr {
            grid-auto-rows: 1fr;
        }

        /* Hacer la transición del panel más suave */
        #sidePanel {
            max-width: 24rem;
            min-width: 0;
        }

        /* Evitar saltos en el layout */
        #mainPanel {
            min-width: 0;
        }
    </style>
@stop
