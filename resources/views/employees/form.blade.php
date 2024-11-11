<div class=" rounded-lg border-gray-100 max-w-7xl mx-auto">
    <div class="p-8">
        <div class="space-y-8">
            <!-- Primera fila -->
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-5">
                    {{ Form::label('lastname', 'Apellidos', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::text('lastname', $employee->lastname, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('lastname') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Apellido']) }}
                    {!! $errors->first('lastname', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
                <div class="col-span-5">
                    {{ Form::label('name', 'Nombres', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::text('name', $user->name, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('name') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('name', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
                <div class="col-span-2">
                    {{ Form::label('age', 'Edad', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::number('age', $employee->age, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('age') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Edad']) }}
                    {!! $errors->first('age', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
            </div>

            <!-- Segunda fila -->
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-4">
                    {{ Form::label('dni', 'DNI', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::text('dni', $employee->dni, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('dni') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Ingrese su DNI']) }}
                    {!! $errors->first('dni', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
                <div class="col-span-4">
                    {{ Form::label('phone', 'Número de Celular', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::text('phone', $employee->phone, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('phone') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Ingrese su número de celular']) }}
                    {!! $errors->first('phone', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
                <div class="col-span-4">
                    {{ Form::label('Roles', null, ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::select('rols', $roles, false, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('roles') ? ' border-red-300 ring-red-100' : '')]) }}
                    @error('roles')
                        <br>
                        <span class="mt-1.5 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Tercera fila -->
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-6">
                    {{ Form::label('email', 'Correo Electrónico', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::email('email', $user->email, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('email') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Ingrese su correo electrónico']) }}
                    {!! $errors->first('email', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
                <div class="col-span-6">
                    {{ Form::label('password', 'Contraseña', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::password('password', ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('password') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Ingrese su contraseña']) }}
                    {!! $errors->first('password', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
            </div>

            <!-- Cuarta fila -->
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-5">
                    {{ Form::label('address', 'Dirección', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::text('address', $employee->address, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('address') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Ingrese su dirección']) }}
                    {!! $errors->first('address', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
                <div class="col-span-4">
                    {{ Form::label('city', 'Ciudad', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::text('city', $employee->city, ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('city') ? ' border-red-300 ring-red-100' : ''), 'placeholder' => 'Ingrese su ciudad']) }}
                    {!! $errors->first('city', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
                <div class="col-span-3">
                    {{ Form::label('image', 'Subir archivo', ['class' => 'text-sm font-semibold text-gray-600 mb-2 block']) }}
                    {{ Form::file('image', ['class' => 'w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200' . ($errors->has('image') ? ' border-red-300 ring-red-100' : '')]) }}
                    {!! $errors->first('image', '<div class="mt-1.5 text-sm text-red-500">:message</div>') !!}
                </div>
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-start space-x-4 pt-6 border-t border-gray-100">
                <button type="submit" class="flex items-center px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium text-sm">
                    <i class="fas fa-plus-circle mr-2"></i>
                    <span>Guardar cambios</span>
                </button>
                <a href="{{ route('employees.index') }}" class="flex items-center px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200 font-medium text-sm">
                    <i class="fas fa-ban mr-2"></i>
                    <span>Cancelar</span>
                </a>
            </div>
        </div>
    </div>
</div>
