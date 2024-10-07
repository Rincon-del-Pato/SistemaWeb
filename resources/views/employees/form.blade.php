<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group row">
            <div class="col-md-5">
                {{ Form::label('lastname', 'Apellidos') }}
                {{ Form::text('lastname', $employee->lastname, ['class' => 'form-control' . ($errors->has('lastname') ? ' is-invalid' : ''), 'placeholder' => 'Apellido']) }}
                {!! $errors->first('lastname', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-5">
                {{ Form::label('name', 'Nombres') }}
                {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <!-- Edad -->
            <div class="col-md-2">
                {{ Form::label('age', 'Edad') }}
                {{ Form::number('age', $employee->age, ['class' => 'form-control' . ($errors->has('age') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su edad']) }}
                {!! $errors->first('age', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="form-group row">
            <!-- DNI -->
            <div class="col-md-4">
                {{ Form::label('dni', 'DNI') }}
                {{ Form::text('dni', $employee->dni, ['class' => 'form-control' . ($errors->has('dni') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su DNI']) }}
                {!! $errors->first('dni', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <!-- Número de celular -->
            <div class="col-md-4">
                {{ Form::label('phone', 'Número de Celular') }}
                {{ Form::text('phone', $employee->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su número de celular']) }}
                {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-4">
                {{ Form::label('Roles') }}
                {{ Form::select('rols', $roles,false,['class' => 'form-control' . ($errors->has('roles') ? ' is-invalid' : '')]) }}
                @error('roles')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <!-- Correo -->
            <div class="col-md-6">
                {{ Form::label('email', 'Correo Electrónico') }}
                {{ Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su correo electrónico']) }}
                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <!-- Contraseña -->
            <div class="col-md-6">
                {{ Form::label('password', 'Contraseña') }}
                {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su contraseña']) }}
                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="form-group row">
            <!-- Dirección -->
            <div class="col-md-6">
                {{ Form::label('address', 'Dirección') }}
                {{ Form::text('address', $employee->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su dirección']) }}
                {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <!-- Ciudad -->
            <div class="col-md-6">
                {{ Form::label('city', 'Ciudad') }}
                {{ Form::text('city', $employee->city, ['class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su ciudad']) }}
                {!! $errors->first('city', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
