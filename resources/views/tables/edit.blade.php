@extends('adminlte::page')

@section('title', 'Mesas')



@section('content_header')
    <h1>Editar mesas</h1>
@stop

@section('content')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                {{-- <div class="card card-default">
                    <div class="card-body">
                        <form method="POST" action="{{ route('tables.update', $table) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <!-- Campo para el nombre de la mesa -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la Mesa:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $table->name }}" required>
                            </div>

                            <!-- Campo para la capacidad -->
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Capacidad:</label>
                                <input type="number" class="form-control" id="capacity" name="capacity"
                                    value="{{ $table->capacity }}" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Estado:</label>
                                <select class="form-select" id="status" name="status" required>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}" {{ $table->status->value == $status->value ? 'selected' : '' }}>
                                            {{ $status->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Botón de envío -->
                            <div class="mt-4 d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Actualizar Mesa</button>
                            </div>

                        </form>
                    </div>
                </div> --}}

                <div class="card-body">
                    {!! Form::model($table, [
                        'route' => ['tables.update', $table],
                        'method' => 'PATCH',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-4">
                            {!! Form::label('name', 'Nombre de la Mesa') !!}
                            {!! Form::text('name', $table->name, [
                                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                'required',
                            ]) !!}
                            @error('name')
                                <br>
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            {!! Form::label('capacity', 'Capacidad') !!}
                            {!! Form::number('capacity', $table->capacity, [
                                'class' => 'form-control' . ($errors->has('capacity') ? ' is-invalid' : ''),
                                'min' => 1,
                                'required',
                            ]) !!}
                            @error('capacity')
                                <br>
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            {!! Form::label('status', 'Estado') !!}
                            {!! Form::select('status', collect($statuses)->pluck('value', 'value')->toArray(), $table->status->value, [
                                'class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''),
                                'required',
                            ]) !!}
                            @error('status')
                                <br>
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="mt-4 d-flex justify-content-between">
                        {!! Form::submit('Actualizar Mesa', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </section>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
