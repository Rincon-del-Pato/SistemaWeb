<div class="w-full">
    <div class="mb-8">
        <label for="name" class="block mb-2 text-lg font-medium text-gray-900">
            Nombre del Rol
        </label>
        <input type="text" name="name" id="name"
            value="{{ $role->name ?? old('name') }}"
            class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
            required>
    </div>

    <div class="mb-8">
        <label class="block mb-4 text-lg font-medium text-gray-900">
            Permisos
        </label>
        <div class="p-6 bg-white border border-gray-200 rounded-lg">
            <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                @foreach($permissions as $permission)
                    <label class="flex items-center p-2 space-x-3 rounded-md cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="permissions[]"
                            value="{{ $permission->id }}"
                            {{ (isset($role) && $role->permissions->contains($permission->id)) ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded form-checkbox focus:ring-blue-500 checked:bg-blue-600">
                        <span class="text-sm font-medium text-gray-700 select-none">
                            {{ $permission->name }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('roles.index') }}"
            class="px-6 py-3 text-sm font-medium text-gray-900 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            Cancelar
        </a>
        <button type="submit"
            class="px-6 py-3 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
            Guardar
        </button>
    </div>
</div>
