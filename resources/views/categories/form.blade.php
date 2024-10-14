<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group row">
            <div class="col-md-4">
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', $category->name ?? '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-8">
                {{ Form::label('description', 'Descripcion') }}
                {{ Form::text('description', $category->description ?? '', ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> <span class="ml-1">Enviar</span>
        </button>
        <a href="{{ route('categories.index') }}" class="btn btn-danger">
            <i class="fas fa-ban"></i> <span class="ml-1">Cancelar</span>
        </a>
    </div>
</div>
