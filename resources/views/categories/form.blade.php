<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group row">
            <div class="col-md-5">
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', $category->name ?? '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-5">
                {{ Form::label('description', 'Descripcion') }}
                {{ Form::text('description', $category->description ?? '', ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
