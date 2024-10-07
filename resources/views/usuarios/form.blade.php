<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group row">
            <div class="col-md-6">
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', $usuario->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-6">
                {{ Form::label('Roles') }}
                {{ Form::select('rols', $roles, false, ['class' => 'form-control' . ($errors->has('roles') ? ' is-invalid' : '')]) }}
                @error('roles')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', $usuario->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-6">
                {{ Form::label('password', 'Contraseña') }}
                {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
