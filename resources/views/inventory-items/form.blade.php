
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
                @foreach(\App\Enums\ItemType::cases() as $type)
                    <option value="{{ $type->value }}" 
                        {{ (isset($inventoryItem) && $inventoryItem->item_type == $type) ? 'selected' : '' }}>
                        {{ ucfirst($type->value) }}
                    </option>
                @endforeach
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

        <div class="mb-8">
            <label for="quantity" class="block mb-2 text-lg font-medium text-gray-900">
                Cantidad
            </label>
            <input type="number" name="quantity" id="quantity"
                value="{{ $inventoryItem->quantity ?? old('quantity') }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                required min="0">
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