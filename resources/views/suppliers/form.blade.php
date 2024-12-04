
<div class="w-full">
    <div class="mb-6">
        <label for="name" class="block mb-2 text-lg font-medium text-gray-900">
            Nombre de la Empresa
        </label>
        <input type="text" name="name" id="name"
            value="{{ $supplier->name ?? old('name') }}"
            class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
            required>
    </div>

    <div class="mb-6">
        <label for="contact_name" class="block mb-2 text-lg font-medium text-gray-900">
            Nombre del Contacto
        </label>
        <input type="text" name="contact_name" id="contact_name"
            value="{{ $supplier->contact_name ?? old('contact_name') }}"
            class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
            required>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="phone" class="block mb-2 text-lg font-medium text-gray-900">
                Teléfono
            </label>
            <input type="tel" name="phone" id="phone"
                value="{{ $supplier->phone ?? old('phone') }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <div>
            <label for="email" class="block mb-2 text-lg font-medium text-gray-900">
                Correo Electrónico
            </label>
            <input type="email" name="email" id="email"
                value="{{ $supplier->email ?? old('email') }}"
                class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>
    </div>

    <div class="mb-8">
        <label for="address" class="block mb-2 text-lg font-medium text-gray-900">
            Dirección
        </label>
        <textarea name="address" id="address" rows="3"
            class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
            required>{{ $supplier->address ?? old('address') }}</textarea>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('suppliers.index') }}"
            class="px-6 py-3 text-sm font-medium text-gray-900 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            Cancelar
        </a>
        <button type="submit"
            class="px-6 py-3 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
            Guardar
        </button>
    </div>
</div>