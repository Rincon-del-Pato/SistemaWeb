<div class="w-full">
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
        <div>
            <label for="name" class="block mb-2 text-lg font-medium text-gray-900">
                Nombre
            </label>
            {{ Form::text('name', $usuario->name, [
                'class' => 'block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500',
                'placeholder' => 'Nombre',
                'required'
            ]) }}
            {!! $errors->first('name', '<div class="mt-1 text-sm text-red-500">:message</div>') !!}
        </div>

        <div>
            <label for="email" class="block mb-2 text-lg font-medium text-gray-900">
                Email
            </label>
            {{ Form::text('email', $usuario->email, [
                'class' => 'block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500',
                'placeholder' => 'Email',
                'required'
            ]) }}
            {!! $errors->first('email', '<div class="mt-1 text-sm text-red-500">:message</div>') !!}
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
        <div>
            <label for="password" class="block mb-2 text-lg font-medium text-gray-900">
                Contraseña
            </label>
            {{ Form::password('password', [
                'class' => 'block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500',
                'placeholder' => 'Contraseña'
            ]) }}
            {!! $errors->first('password', '<div class="mt-1 text-sm text-red-500">:message</div>') !!}
        </div>

        <div>
            <label class="block mb-2 text-lg font-medium text-gray-900">
                Roles
            </label>
            {{ Form::select('rols', $roles, null, [
                'class' => 'block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500'
            ]) }}
            @error('roles')
                <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('usuarios.index') }}"
            class="px-6 py-3 text-sm font-medium text-gray-900 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            Cancelar
        </a>
        <button type="submit"
            class="px-6 py-3 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
            Guardar
        </button>
    </div>
</div>


