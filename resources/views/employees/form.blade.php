<div class="space-y-6">
    <!-- Información Personal -->
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <h2 class="mb-4 text-xl font-semibold text-gray-900">Información Personal</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Apellidos -->
            <div>
                <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">Apellidos</label>
                <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $employee->lastname ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('lastname')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombres</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="age" class="block mb-2 text-sm font-medium text-gray-900">Edad</label>
                <input type="number" name="age" id="age" value="{{ old('age', $employee->age ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('age')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Información de Contacto -->
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <h2 class="mb-4 text-xl font-semibold text-gray-900">Información de Contacto</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
                <label for="dni" class="block mb-2 text-sm font-medium text-gray-900">DNI</label>
                <input type="text" name="dni" id="dni" value="{{ old('dni', $employee->dni ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('dni')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Teléfono</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rols" class="block mb-2 text-sm font-medium text-gray-900">Rol</label>
                <select name="rols" id="rols" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    @foreach($roles as $name => $description)
                        <option value="{{ $name }}" {{
                            old('rols',
                                isset($employee->user) && $employee->user->roles->isNotEmpty()
                                    ? $employee->user->roles->first()->name
                                    : ''
                            ) == $name ? 'selected' : ''
                        }}>
                            {{ $description }}
                        </option>
                    @endforeach
                </select>
                @error('rols')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Información de Cuenta -->
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <h2 class="mb-4 text-xl font-semibold text-gray-900">Información de Cuenta</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                <input type="password" name="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Dirección -->
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <h2 class="mb-4 text-xl font-semibold text-gray-900">Dirección</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="md:col-span-2">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Dirección</label>
                <input type="text" name="address" id="address" value="{{ old('address', $employee->address ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Ciudad</label>
                <input type="text" name="city" id="city" value="{{ old('city', $employee->city ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                @error('city')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Imagen de Perfil -->
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm">
        <h2 class="mb-4 text-xl font-semibold text-gray-900">Imagen de Perfil</h2>
        <div class="space-y-4">
            @if(isset($user) && $user->profile_photo_path)
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                         alt="Foto de perfil"
                         class="object-cover w-32 h-32 border border-gray-200 rounded-lg cursor-pointer hover:opacity-75"
                         onclick="openImageModal(this.src)"
                         id="preview-image">
                    <div class="text-sm text-gray-500">
                        <p>Imagen actual</p>
                        <p class="text-xs">Sube una nueva imagen para reemplazarla</p>
                    </div>
                </div>
            @endif

            <!-- Modal para zoom de imagen -->
            <div id="imageModal" class="fixed inset-0 z-50 items-center justify-center hidden p-4 bg-black bg-opacity-50">
                <div class="relative flex items-center justify-center w-full h-full">
                    <button type="button" onclick="closeImageModal(event)" class="absolute p-2 bg-white rounded-full top-4 right-4 hover:bg-gray-100 z-60">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <img src="" alt="Imagen ampliada" class="max-h-[80vh] max-w-[90vw] rounded-lg object-contain" id="modal-image">
                </div>
            </div>

            <div class="flex items-center justify-center w-full">
                <label for="profile_photo_path" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir</span> o arrastra y suelta</p>
                    <p class="text-xs text-gray-500">PNG, JPG (MAX. 800x400px)</p>
                </div>
                <input id="profile_photo_path" name="profile_photo_path" type="file" class="hidden" accept="image/*" />
            </label>
        </div>
        @error('profile_photo_path')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex items-center justify-end space-x-4">
    <a href="{{ route('employees.index') }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Cancelar
    </a>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Guardar
    </button>
</div>
</div>

<script>
    function openImageModal(src) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modal-image');
        modalImage.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeImageModal(event) {
        event.preventDefault();
        const modal = document.getElementById('imageModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
