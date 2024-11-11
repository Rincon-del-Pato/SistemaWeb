<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group row">
            <div class="col-md-4">
                {{ Form::label('name', 'Nombre') }}
                {{ Form::text('name', $product->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Ej: Tamalitos verdes']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-4">
                {{ Form::label('image', 'Subir imagen') }}
                {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : '')]) }}
                {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('category_id', 'Categoría') !!}
                {!! Form::select('category_id', $category->pluck('name', 'id'), $product->category_id, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione una categoría',
                ]) !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                {{ Form::label('description', 'Descripción') }}
                {{ Form::textarea('description', $product->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        {{-- <div class="form-group row">
            <div class="col-md-4">
                {{ Form::label('size', 'Seleccionar tamaño') }}
                <div>
                    @foreach ($size as $sizeOption)
                        <div class="form-check">
                            {{ Form::radio('size', $sizeOption->value, $sizeOption->value === 'Unico', [
                                'class' => 'form-check-input',
                                'id' => 'size_' . $sizeOption->value,
                                'onclick' => 'handleSizeSelection()',
                            ]) }}
                            {{ Form::label('size_' . $sizeOption->value, $sizeOption->value, ['class' => 'form-check-label']) }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                {{ Form::label('price', 'Price') }}
                {{ Form::number('price', $product->price, [
                    'class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''),
                    'placeholder' => '0.00',
                    'min' => '0',
                    'step' => '1.00',
                ]) }}
                {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('status', 'Estado') !!}
                {!! Form::select('status', collect($status)->pluck('value', 'value'), $product->status, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione un estado',
                ]) !!}
            </div>
        </div> --}}
        <div class="form-group row">
            <div class="col-md-3">
                {{ Form::label('type', 'Seleccionar Tipo(s)') }}
                <div>
                    <div class="form-check">
                        {{ Form::checkbox('types[]', 'Unico', in_array('Unico', $productTypes), [
                            'class' => 'form-check-input',
                            'id' => 'type_unico',
                            'onclick' => 'handleTypeSelection("Unico")',
                        ]) }}
                        {{ Form::label('type_unico', 'Único', ['class' => 'form-check-label']) }}
                    </div>
                    <div class="form-check">
                        {{ Form::checkbox('types[]', 'Personal', in_array('Personal', $productTypes), [
                            'class' => 'form-check-input',
                            'id' => 'type_personal',
                            'onclick' => 'handleTypeSelection("Personal")',
                        ]) }}
                        {{ Form::label('type_personal', 'Personal', ['class' => 'form-check-label']) }}
                    </div>
                    <div class="form-check">
                        {{ Form::checkbox('types[]', 'Fuente', in_array('Fuente', $productTypes), [
                            'class' => 'form-check-input',
                            'id' => 'type_fuente',
                            'onclick' => 'handleTypeSelection("Fuente")',
                        ]) }}
                        {{ Form::label('type_fuente', 'Fuente', ['class' => 'form-check-label']) }}
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Campos dinámicos para precios y estados -->
                <div id="dynamic_fields" class="mt-3">
                    <div id="unico_fields" style="display: none;">
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('price_unico', 'Precio Único') }}
                                {{ Form::number('prices[Unico]', $prices['Unico'], ['class' => 'form-control', 'placeholder' => '0.00', 'min' => '0', 'step' => '0.01']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('status_unico', 'Estado Único') }}
                                {{ Form::select('statuses[Unico]', ['Disponible' => 'Disponible', 'Oculto' => 'Oculto'], $statuses['Unico'], ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div id="personal_fields" style="display: none;">
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('price_personal', 'Precio Personal') }}
                                {{ Form::number('prices[Personal]', $prices['Personal'], ['class' => 'form-control', 'placeholder' => '0.00', 'min' => '0', 'step' => '0.01']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('status_personal', 'Estado Personal') }}
                                {{ Form::select('statuses[Personal]', ['Disponible' => 'Disponible', 'Oculto' => 'Oculto'], $statuses['Personal'], ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div id="fuente_fields" style="display: none;">
                        <div class="form-group row">
                            <div class="col-md-6">
                                {{ Form::label('price_fuente', 'Precio Fuente') }}
                                {{ Form::number('prices[Fuente]', $prices['Fuente'], ['class' => 'form-control', 'placeholder' => '0.00', 'min' => '0', 'step' => '0.01']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('status_fuente', 'Estado Fuente') }}
                                {{ Form::select('statuses[Fuente]', ['Disponible' => 'Disponible', 'Oculto' => 'Oculto'], $statuses['Fuente'], ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="box-footer mt20">
    {{-- <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> <span class="ml-1">Enviar</span>
    </button> --}}

    <button type="button" class="btn btn-primary" onclick="confirmarEnvio()">
        <i class="fas fa-plus-circle"></i> <span class="ml-1">Enviar</span>
    </button>
    <a href="{{ route('products.index') }}" class="btn btn-danger">
        <i class="fas fa-ban"></i> <span class="ml-1">Cancelar</span>
    </a>
</div>
</div>


<script>
    // Función para mostrar/ocultar campos según los tipos seleccionados
    function handleTypeSelection(type) {
        const unicoCheckbox = document.getElementById('type_unico');
        const personalCheckbox = document.getElementById('type_personal');
        const fuenteCheckbox = document.getElementById('type_fuente');

        const unicoFields = document.getElementById('unico_fields');
        const personalFields = document.getElementById('personal_fields');
        const fuenteFields = document.getElementById('fuente_fields');

        // Si se selecciona "Unico", deseleccionar los otros
        if (type === 'Unico' && unicoCheckbox.checked) {
            personalCheckbox.checked = false;
            fuenteCheckbox.checked = false;
            personalFields.style.display = 'none';
            fuenteFields.style.display = 'none';
            unicoFields.style.display = 'block';
            return;
        }

        // Si se selecciona cualquier otro tipo, deseleccionar "Unico"
        if (type !== 'Unico' && (personalCheckbox.checked || fuenteCheckbox.checked)) {
            unicoCheckbox.checked = false;
            unicoFields.style.display = 'none';
        }

        // Mostrar/ocultar campos según las selecciones
        personalFields.style.display = personalCheckbox.checked ? 'block' : 'none';
        fuenteFields.style.display = fuenteCheckbox.checked ? 'block' : 'none';
    }

    // Ejecutar al cargar la página para establecer el estado inicial
    document.addEventListener('DOMContentLoaded', function() {
        const types = ['Unico', 'Personal', 'Fuente'];
        types.forEach(type => {
            const checkbox = document.getElementById('type_' + type.toLowerCase());
            if (checkbox.checked) {
                handleTypeSelection(type);
            }
        });
    });
</script>
