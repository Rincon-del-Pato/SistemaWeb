<div class="w-full">
    <div class="mb-8">
        <label for="name" class="block mb-2 text-lg font-medium text-gray-900">
            Nombre del Artículo
        </label>
        <input type="text" name="name" id="name"
            value="{{ $inventoryItem->name ?? old('name') }}"
            class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
            required>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="mb-8">
            <label for="item_type" class="block mb-2 text-lg font-medium text-gray-900">
                Tipo de Artículo
            </label>
            <select name="item_type" id="item_type"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500">
                <option value="Ingrediente" {{ (isset($inventoryItem) && $inventoryItem->item_type == 'Ingrediente') ? 'selected' : '' }}>
                    Ingrediente
                </option>
                <option value="Preenvasado" {{ (isset($inventoryItem) && $inventoryItem->item_type == 'Preenvasado') ? 'selected' : '' }}>
                    Preenvasado
                </option>
            </select>
        </div>

        <div class="mb-8">
            <label for="supplier_id" class="block mb-2 text-lg font-medium text-gray-900">
                Proveedor
            </label>
            <select name="supplier_id" id="supplier_id"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500">
                <option value="">Seleccione un proveedor</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                        {{ (isset($inventoryItem) && $inventoryItem->supplier_id == $supplier->id) ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-8" id="quantity-container">
            <label for="quantity" class="block mb-2 text-lg font-medium text-gray-900">
                <span id="quantity-label">Cantidad</span>
            </label>
            <input type="number" name="quantity" id="quantity"
                value="{{ $inventoryItem->quantity ?? old('quantity') }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                required min="0" step="any">
        </div>

        <div class="mb-8">
            <label for="reorder_level" class="block mb-2 text-lg font-medium text-gray-900">
                Nivel de Reorden
            </label>
            <input type="number" name="reorder_level" id="reorder_level"
                value="{{ $inventoryItem->reorder_level ?? old('reorder_level') }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                required min="0">
        </div>

        <div class="mb-8">
            <label for="unit_id" class="block mb-2 text-lg font-medium text-gray-900">
                Unidad
            </label>
            <select name="unit_id" id="unit_id"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                required>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}"
                        {{ (isset($inventoryItem) && $inventoryItem->unit_id == $unit->id) ? 'selected' : '' }}>
                        {{ $unit->unit_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-8">
            <label for="num_units" class="block mb-2 text-lg font-medium text-gray-900">
                Stock (unidades)
            </label>
            <input type="number" name="num_units" id="num_units"
                value="{{ $inventoryItem->num_units ?? old('num_units') }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                min="1">
        </div>

        <div class="mb-8">
            <label for="cost_price" class="block mb-2 text-lg font-medium text-gray-900">
                Precio de Costo
            </label>
            <input type="number" name="cost_price" id="cost_price" step="0.01"
                value="{{ $inventoryItem->cost_price ?? old('cost_price') }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                required min="0">
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('inventory.index') }}"
            class="px-6 py-3 text-sm font-medium text-gray-900 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            Cancelar
        </a>
        <button type="submit"
            class="px-6 py-3 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
            Guardar
        </button>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemTypeSelect = document.getElementById('item_type');
        const numUnitsInput = document.getElementById('num_units');
        const numUnitsContainer = numUnitsInput.closest('.mb-8');
        const quantityLabel = document.getElementById('quantity-label');

        function toggleFields() {
            if (itemTypeSelect.value === 'Preenvasado') {
                numUnitsContainer.classList.remove('hidden');
                numUnitsInput.required = true;
                quantityLabel.textContent = 'Contenido por Unidad';
            } else {
                numUnitsContainer.classList.add('hidden');
                numUnitsInput.required = false;
                numUnitsInput.value = '';
                quantityLabel.textContent = 'Cantidad';
            }
        }

        itemTypeSelect.addEventListener('change', toggleFields);
        toggleFields();
    });
</script>
@endpush
