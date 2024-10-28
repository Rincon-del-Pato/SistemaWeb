@extends('adminlte::page')

@section('title', 'Detalle de Venta')

@section('content_header')
    <h1>Informacion de Venta</h1>
@stop

@section('content')


<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Venta</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <strong>Nombre del Rol:</strong>
                        {{ $role->name }}
                    </div>
                    <div class="form-group">
                        <strong>Permisos que tiene el rol:</strong>
                            {{$role->Permissions->count()}}
                    </div>
                    <div class="form-group">
                        <strong>Permisos que tiene el ro:</strong>
                        @if(!empty($role->Permissions))
                        <ul>
                            @foreach($role->Permissions as $v)
                            <li>{{ $v->description }}</li>
                            @endforeach
                        </ul>
                    @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
