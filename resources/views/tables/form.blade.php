<div class="w-full max-w-md mx-auto"> <!-- Añadido max-w-md y mx-auto -->
    <div class="space-y-4"> <!-- Cambiado space-y-6 a space-y-4 para reducir espaciado vertical -->
        <div class="mb-6">
            <label for="table_number" class="block mb-2 text-lg font-medium text-gray-900">
                Número de Mesa
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <i class="fas fa-hashtag"></i>
                </span>
                <input type="number" name="table_number" id="table_number"
                    value="{{ $table->table_number ?? old('table_number') }}"
                    class="block w-full p-3 pl-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                    min="1"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required>
            </div>
            @error('table_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="seating_capacity" class="block mb-2 text-lg font-medium text-gray-900">
                Capacidad de Asientos
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <i class="fas fa-users"></i>
                </span>
                <input type="number" name="seating_capacity" id="seating_capacity"
                    value="{{ $table->seating_capacity ?? old('seating_capacity') }}"
                    class="block w-full p-3 pl-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                    min="1" required>
            </div>
            @error('seating_capacity')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block mb-2 text-lg font-medium text-gray-900">
                Estado
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <i class="fas fa-circle"></i>
                </span>
                <select name="status" id="status"
                    class="block w-full p-3 pl-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500">
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}" 
                            {{ (isset($table) && $table->status->value === $status->value) ? 'selected' : '' }}>
                            {{ $status->value }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('tables.index') }}"
                class="flex items-center px-6 py-3 text-sm font-medium text-gray-900 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
                <i class="mr-2 fas fa-times"></i> Cancelar
            </a>
            <button type="submit"
                class="flex items-center px-6 py-3 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
                <i class="mr-2 fas fa-save"></i> {{ isset($table) ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </div>
</div>