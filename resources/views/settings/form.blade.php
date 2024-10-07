<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group row">
            <div class="col-md-3">
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', $setting->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Ingresar nombre']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-2">
                {{ Form::label('ruc', 'RUC') }}
                {{ Form::number('ruc', $setting->ruc, ['class' => 'form-control' . ($errors->has('ruc') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese RUC']) }}
                {!! $errors->first('ruc', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-3">
                {{ Form::label('phone', 'Número de Telefono') }}
                {{ Form::text('phone', $setting->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su número de telefono']) }}
                {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-4">
                {{ Form::label('address', 'Dirección') }}
                {{ Form::text('address', $setting->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese su direccion']) }}
                {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                {{ Form::label('email', 'Correo Electrónico') }}
                {{ Form::email('email', $setting->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el correo electrónico']) }}
                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-3">
                {{ Form::label('province', 'Provincia') }}
                {{ Form::text('province', $setting->province, ['class' => 'form-control' . ($errors->has('province') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la provincia']) }}
                {!! $errors->first('province', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-3">
                {{ Form::label('city', 'Ciudad') }}
                {{ Form::text('city', $setting->city, ['class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la ciudad']) }}
                {!! $errors->first('city', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-3">
                {{ Form::label('image', 'Subir Imagen') }}
                {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : '')]) }}
                {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
