@extends('adminlte::page')

@section('title', 'Mesas')



@section('content_header')
    <h1>Crear mesas</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Mesas</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tables.store') }}" method="POST">
                            @csrf
                            <div id="table-types">
                                <div class="mb-3 form-group row align-items-center">
                                    <div class="col-md-4">
                                        {{ Form::label('capacity[]', 'Capacidad Nº Personas:') }}
                                        {!! Form::number('capacity[]', null, [
                                            'class' => 'form-control',
                                            'min' => 1,
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::label('quantity[]', 'Nº de Mesas:') !!}
                                        {!! Form::number('quantity[]', null, [
                                            'class' => 'form-control',
                                            'min' => 1,
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    <div class="text-center col-md-2">
                                        <button type="button" class="btn btn-danger remove-type" style="display: none;" onclick="removeTableType(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary" onclick="addTableType()">
                                    <i class="fas fa-plus-circle"></i> Agregar Tipo de Mesa
                                </button>
                                <button type="submit" class="btn btn-success">
                                    Crear Mesas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function addTableType() {
            const container = document.getElementById('table-types');
            const newType = container.children[0].cloneNode(true);
            newType.querySelectorAll('input').forEach(input => input.value = '');
            container.appendChild(newType);
            updateRemoveButtons();
        }

        function removeTableType(button) {
            const container = document.getElementById('table-types');
            if (container.children.length > 1) {
                button.closest('.form-group').remove();
            }
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const container = document.getElementById('table-types');
            const buttons = container.querySelectorAll('.remove-type');
            buttons.forEach(button => {
                if (container.children.length > 1) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', updateRemoveButtons);
    </script>





    {{-- <script>
            function addTableType() {
                const container = document.getElementById('table-types');
                const newType = container.children[0].cloneNode(true);
                newType.querySelectorAll('input').forEach(input => input.value = '');
                container.appendChild(newType);
            }

            function removeTableType(button) {
                const container = document.getElementById('table-types');
                if (container.children.length > 1) {
                    button.closest('.mb-4').remove();
                }
            }
        </script> --}}


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
