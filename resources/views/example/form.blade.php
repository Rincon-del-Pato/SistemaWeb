<div class="p-6 rounded-lg">
    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                {{ Form::label('name', 'Nombre', ['class' => 'block mb-2 text-sm font-medium text-gray-700']) }}
                {{ Form::text('name', $usuario->name, [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500' .
                    ($errors->has('name') ? ' border-red-500' : ''),
                    'placeholder' => 'Nombre'
                ]) }}
                {!! $errors->first('name', '<div class="mt-1 text-sm text-red-500">:message</div>') !!}
            </div>
            <div>
                {{ Form::label('Roles', null, ['class' => 'block mb-2 text-sm font-medium text-gray-700']) }}
                {{ Form::select('rols', $roles, false, [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500' .
                    ($errors->has('roles') ? ' border-red-500' : '')
                ]) }}
                @error('roles')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                {{ Form::label('email', 'Email', ['class' => 'block mb-2 text-sm font-medium text-gray-700']) }}
                {{ Form::text('email', $usuario->email, [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500' .
                    ($errors->has('email') ? ' border-red-500' : ''),
                    'placeholder' => 'Email'
                ]) }}
                {!! $errors->first('email', '<div class="mt-1 text-sm text-red-500">:message</div>') !!}
            </div>
            <div>
                {{ Form::label('password', 'Contraseña', ['class' => 'block mb-2 text-sm font-medium text-gray-700']) }}
                {{ Form::password('password', [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500' .
                    ($errors->has('password') ? ' border-red-500' : ''),
                    'placeholder' => 'Contraseña'
                ]) }}
                {!! $errors->first('password', '<div class="mt-1 text-sm text-red-500">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-6 space-x-4">
        <a href="{{ route('usuarios.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Enviar
        </button>
    </div>
</div>


