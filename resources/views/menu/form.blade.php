<div class="space-y-6">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Nombre del producto -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                Nombre del producto
            </label>
            <input type="text" name="name" id="name"
                value="{{ $menuItem->name ?? old('name') }}"
                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <!-- Categoría -->
        <div>
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">
                Categoría
            </label>
            <select name="category_id" id="category_id"
                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Seleccionar categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ (isset($menuItem) && $menuItem->category_id == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Descripción -->
    <div>
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
            Descripción
        </label>
        <textarea name="description" id="description" rows="3"
            class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500">{{ $menuItem->description ?? old('description') }}</textarea>
    </div>

    <!-- Tamaños y precios -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900">
            Tamaños y precios
        </label>
        <div id="sizes-container" class="space-y-4">
            <template x-for="(size, index) in sizes" :key="index">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <select :name="'sizes['+index+'][size_id]'"
                            class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-4">
                        <input type="number" :name="'sizes['+index+'][price]'" step="0.01" min="0"
                            class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm"
                            placeholder="Precio">
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

    <!-- Botones de acción -->
    <div class="flex justify-end gap-3">
        <a href="{{ route('menu-item-sizes.index') }}"
            class="px-6 py-3 text-sm font-medium text-gray-900 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            Cancelar
        </a>
        <button type="submit"
            class="px-6 py-3 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
            Guardar
        </button>
    </div>
</div>

@push('scripts')
<script>
    function menuItemForm() {
        return {
            sizes: [],
            addSize() {
                this.sizes.push({});
            },
            removeSize(index) {
                this.sizes.splice(index, 1);
            }
        }
    }
</script>
@endpush
