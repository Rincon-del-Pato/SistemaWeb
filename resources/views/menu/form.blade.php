<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group row">
            <div class="col-md-6">
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', $product->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Ej: Tamalitos verdes']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-6">
                {{ Form::label('price', 'Price') }}
                {{ Form::number('price', $product->price, [
                    'class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''),
                    'placeholder' => '0.00',
                    'min' => '0',
                    'step' => '1.00',
                ]) }}
                {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                {{ Form::label('description', 'Descripción') }}
                {{ Form::textarea('description', $product->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                {!! Form::label('status', 'Estado') !!}
                {!! Form::select('status', collect($status)->pluck('name', 'value'), $product->status, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione un estado',
                ]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('category_id', 'Categoría') !!}
                {!! Form::select('category_id', $category->pluck('name', 'id'), $product->category_id, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione una categoría',
                ]) !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-dark">
            <i class="fas fa-plus-circle"></i> <span class="ml-1">Agregar producto</span>
        </button>
        <a href="{{ route('products.index') }}" class="btn btn-danger">
            <i class="fas fa-ban"></i> <span class="ml-1">Cancelar</span>
        </a>
    </div>
</div>
