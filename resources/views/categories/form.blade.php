<div class="w-full">
    <div class="mb-8">
        <label for="name" class="block mb-2 text-lg font-medium text-gray-900">
            Nombre de la Categoría
        </label>
        <input type="text" name="name" id="name"
            value="{{ $category->name ?? old('name') }}"
            class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
            required>
    </div>

    <div class="mb-8">
        <label for="description" class="block mb-2 text-lg font-medium text-gray-900">
            Descripción
        </label>
        <input type="text" name="description" id="description"
            value="{{ $category->description ?? old('description') }}"
            class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
            required>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('categories.index') }}"
            class="px-6 py-3 text-sm font-medium text-gray-900 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            Cancelar
        </a>
        <button type="submit"
            class="px-6 py-3 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
            Guardar
        </button>
    </div>
</div>
