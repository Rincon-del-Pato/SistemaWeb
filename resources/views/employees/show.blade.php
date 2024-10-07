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
                <div class="text-white card-header bg-primary">
                    <h3 class="card-title">Información del Empleado</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="mb-3">{{ $employee->lastname }} {{ $employee->user->name }}</h2>
                            <span class="badge bg-info text-dark" style="font-size: 1rem">
                                {{ $employee->user->getRoleNames()->implode(', ') }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="mr-2 fas fa-id-card"></i>
                                    <strong>Nº:</strong> {{ $employee->id }}
                                </li>
                                <li class="list-group-item">
                                    <i class="mr-2 fas fa-envelope"></i>
                                    <strong>Email:</strong> {{ $employee->user->email }}
                                </li>
                                <li class="list-group-item">
                                    <i class="mr-2 fas fa-id-badge"></i>
                                    <strong>DNI:</strong> {{ $employee->dni }}
                                </li>
                                <li class="list-group-item">
                                    <i class="mr-2 fas fa-phone"></i>
                                    <strong>Celular:</strong> {{ $employee->phone }}
                                </li>
                                @if($employee->birthdate)
                                    <li class="list-group-item">
                                        <i class="mr-2 fas fa-birthday-cake"></i>
                                        <strong>Fecha de Nacimiento:</strong> {{ $employee->birthdate->format('d/m/Y') }}
                                    </li>
                                @endif
                                @if($employee->address)
                                    <li class="list-group-item">
                                        <i class="mr-2 fas fa-map-marker-alt"></i>
                                        <strong>Dirección:</strong> {{ $employee->address }}
                                    </li>
                                @endif
                            </ul>
                        </div>
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
