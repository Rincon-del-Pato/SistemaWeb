<div class="space-y-6" x-data="menuItemForm">
    <!-- Nombre y Categoría -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="col-span-2 md:col-span-1">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                Nombre del producto *
            </label>
            <input type="text" name="name" id="name"
                value="{{ $menuItem->name ?? old('name') }}"
                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <div class="col-span-2 md:col-span-1">
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">
                Categoría *
            </label>
            <select name="category_id" id="category_id"
                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500"
                required>
                <option value="">Seleccionar categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ (isset($menuItem) && $menuItem->category_id == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Descripción en nueva fila, ocupando todo el ancho -->
        <div class="col-span-2">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                Descripción *
            </label>
            <textarea name="description" id="description" rows="3"
                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500"
                required>{{ $menuItem->description ?? old('description') }}</textarea>
        </div>
    </div>

    <!-- Tipo de producto -->
    <div class="grid grid-cols-1 gap-6">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Tipo de producto *</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="product_type" value="Ingrediente"
                        x-model="productType"
                        class="form-radio">
                    <span class="ml-2">Para elaborar</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="product_type" value="Preenvasado"
                        x-model="productType"
                        class="form-radio">
                    <span class="ml-2">Preenvasado</span>
                </label>
            </div>
        </div>
    </div>

    <!-- Tamaños y precios (siempre visible) -->
    <div class="grid grid-cols-1 gap-6">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">
                Tamaños y precios *
            </label>
            <div id="sizes-container" class="space-y-4">
                <template x-for="(size, index) in sizes" :key="index">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-2">
                            <select :name="'sizes['+index+'][size_id]'"
                                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm"
                                x-model="size.size_id"
                                @change="validateSizeSelection(index)">
                                <option value="">Seleccionar tamaño</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}"
                                        :disabled="isOptionDisabled({{ $size->id }}, index, 'size')">
                                        {{ $size->size_name }}
                                        @if($size->volume)
                                            ({{ number_format($size->volume, 2) }} {{ optional($size->unit)->abbreviation }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center gap-4">
                            <input type="number" :name="'sizes['+index+'][price]'" step="0.01" min="0"
                                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm"
                                placeholder="Precio" x-model="size.price">
                            <button type="button" @click="removeSize(index)"
                                class="p-2 text-red-600 rounded-lg hover:bg-red-100">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
            <button type="button" @click="addSize"
                class="px-4 py-2 mt-4 text-sm font-medium text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-50">
                <i class="fas fa-plus"></i> Agregar tamaño
            </button>
        </div>
    </div>

    <!-- Ingredientes o Preenvasados -->
    <div class="grid grid-cols-1 gap-6" x-show="productType !== ''">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">
                <span x-text="productType === 'Ingrediente' ? 'Ingredientes necesarios *' : 'Producto preenvasado *'"></span>
            </label>

            <!-- Lista de ingredientes -->
            <div x-show="productType === 'Ingrediente'" class="space-y-4">
                <template x-for="(item, index) in inventoryItems" :key="index">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-2">
                            <select :name="'inventory_items['+index+'][inventory_item_id]'"
                                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm"
                                x-model="item.inventory_item_id"
                                @change="validateInventoryItemSelection(index)">
                                <option value="">Seleccionar ingrediente</option>
                                @foreach($ingredientItems as $invItem)
                                    <option value="{{ $invItem->id }}"
                                        :disabled="isOptionDisabled({{ $invItem->id }}, index, 'ingredient')">
                                        {{ $invItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="number" :name="'inventory_items['+index+'][quantity_needed]'"
                                step="0.01" min="0"
                                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm"
                                placeholder="Cantidad necesaria"
                                x-model="item.quantity_needed">
                        </div>
                        <div class="flex items-center">
                            <button type="button" @click="removeInventoryItem(index)"
                                class="p-2 text-red-600 rounded-lg hover:bg-red-100">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </template>
                <button type="button" @click="addInventoryItem"
                    class="px-4 py-2 mt-4 text-sm font-medium text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-50">
                    <i class="fas fa-plus"></i> Agregar ingrediente
                </button>
            </div>

            <!-- Selector de producto preenvasado -->
            <div x-show="productType === 'Preenvasado'">
                <select name="prepackaged_item_id"
                    class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm"
                    x-model="prepackagedItemId">
                    <option value="">Seleccionar producto preenvasado</option>
                    @foreach($prepackagedItems as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($menuItem) && $menuItem->prepackaged_item_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                            @if($item->volume)
                                ({{ number_format($item->volume, 2) }} {{ optional($item->unit)->abbreviation }})
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Disponibilidad (movido al final) -->
    <div class="flex items-center justify-end p-4 border border-gray-200 rounded-lg">
        <label class="inline-flex items-center cursor-pointer">
            <input type="checkbox" name="available" id="available"
                class="sr-only peer"
                {{ (isset($menuItem) ? $menuItem->available : true) ? 'checked' : '' }}>

            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:bg-blue-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900">
                Disponible para venta
            </span>
        </label>
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-end gap-3">
        <a href="{{ route('menu.index') }}"
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
document.addEventListener('alpine:init', () => {
    Alpine.data('menuItemForm', () => ({
        productType: '{{ $menuItem ? $menuItem->product_type : "" }}',
        sizes: {!! isset($menuItem) && $menuItem->sizes ?
            json_encode($menuItem->sizes->map(function($size) {
                return [
                    'size_id' => $size->id,
                    'price' => $size->pivot->price
                ];
            })) : '[{ "size_id": "", "price": "" }]'
        !!},
        inventoryItems: {!! isset($menuItem) && $menuItem->inventoryItems ?
            json_encode($menuItem->inventoryItems->map(function($item) {
                return [
                    'inventory_item_id' => $item->id,
                    'quantity_needed' => $item->pivot->quantity_needed_per_unit
                ];
            })) : '[{ "inventory_item_id": "", "quantity_needed": "" }]'
        !!},
        prepackagedItemId: '{{ $menuItem->prepackaged_item_id ?? "" }}',
        selectedSizes: [],
        selectedIngredients: [],

        init() {
            // Inicializar arrays de selección
            this.selectedSizes = this.sizes.map(s => s.size_id).filter(id => id !== '');
            this.selectedIngredients = this.inventoryItems.map(i => i.inventory_item_id).filter(id => id !== '');
        },

        isOptionDisabled(id, currentIndex, type) {
            if (type === 'size') {
                return this.selectedSizes.includes(id.toString()) &&
                       this.sizes[currentIndex].size_id !== id.toString();
            } else if (type === 'ingredient') {
                return this.selectedIngredients.includes(id.toString()) &&
                       this.inventoryItems[currentIndex].inventory_item_id !== id.toString();
            }
            return false;
        },

        validateSizeSelection(index) {
            const currentSelection = this.sizes[index].size_id;
            this.selectedSizes = this.sizes.map(s => s.size_id).filter(id => id !== '');

            if (currentSelection && this.selectedSizes.filter(id => id === currentSelection).length > 1) {
                alert('Este tamaño ya ha sido seleccionado');
                this.sizes[index].size_id = '';
                this.selectedSizes = this.sizes.map(s => s.size_id).filter(id => id !== '');
            }
        },

        validateInventoryItemSelection(index) {
            const currentSelection = this.inventoryItems[index].inventory_item_id;
            this.selectedIngredients = this.inventoryItems.map(i => i.inventory_item_id).filter(id => id !== '');

            if (currentSelection && this.selectedIngredients.filter(id => id === currentSelection).length > 1) {
                alert('Este ingrediente ya ha sido seleccionado');
                this.inventoryItems[index].inventory_item_id = '';
                this.selectedIngredients = this.inventoryItems.map(i => i.inventory_item_id).filter(id => id !== '');
            }
        },

        addSize() {
            this.sizes.push({ size_id: '', price: '' });
        },

        removeSize(index) {
            if (this.sizes.length > 1) {
                this.sizes.splice(index, 1);
                this.selectedSizes = this.sizes.map(s => s.size_id).filter(id => id !== '');
            }
        },

        addInventoryItem() {
            this.inventoryItems.push({ inventory_item_id: '', quantity_needed: '' });
        },

        removeInventoryItem(index) {
            if (this.inventoryItems.length > 1) {
                this.inventoryItems.splice(index, 1);
                this.selectedIngredients = this.inventoryItems.map(i => i.inventory_item_id).filter(id => id !== '');
            }
        }
    }))
})
</script>
@endpush

