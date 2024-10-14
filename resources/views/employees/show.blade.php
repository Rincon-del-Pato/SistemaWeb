@extends('adminlte::page')

@section('title', 'Detalle del empleado')

@section('content_header')
    {{-- <h1>Informacion de Venta</h1> --}}
@stop

@section('content')


    {{-- <section class="content container-fluid">
        <div class="row">
        <div class="mt-4 col-md-12">
            <div class="card">
                <div class="text-white card-header bg-primary">
                    <h3 class="card-title">Información del Empleado</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="mb-3">{{ $employee->lastname }} {{ $employee->user->name }}, {{ $employee->age }}</h2>
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
                                @if ($employee->birthdate)
                                    <li class="list-group-item">
                                        <i class="mr-2 fas fa-birthday-cake"></i>
                                        <strong>Fecha de Nacimiento:</strong> {{ $employee->birthdate->format('d/m/Y') }}
                                    </li>
                                @endif
                                @if ($employee->address)
                                    <li class="list-group-item">
                                        <i class="mr-2 fas fa-map-marker-alt"></i>
                                        <strong>Dirección:</strong> {{ $employee->address }} - {{ $employee->city }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section> --}}
    <section class="content container-fluid">
        <div class="row">
            <div class="mt-4 col-md-12">
                <div class="mb-4 card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-4 text-center col-md-4 text-md-start mb-md-0">
                                <div class="mb-3">
                                    @if ($employee->user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $employee->user->profile_photo_path) }}"
                                            alt="{{ $employee->lastname }} {{ $employee->user->name }}"
                                            class="img-fluid rounded-circle"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <div class="text-white bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 150px; height: 150px; font-size: 3rem;">
                                            {{ substr($employee->user->name, 0, 1) }}{{ substr($employee->lastname, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <h2 class="mb-1 h4">{{ $employee->lastname }} {{ $employee->user->name }}</h2>
                                <p class="text-muted">{{ $employee->age }} años</p>
                                <span class="badge bg-info" style="font-size: 1rem">
                                    {{ $employee->user->getRoleNames()->implode(', ') }}
                                </span>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <i class="fas fa-id-card me-2"> </i>
                                        <strong class="me-2">Nº: </strong> {{ $employee->id }}
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-envelope me-2"> </i>
                                        <strong class="me-2">Email: </strong> {{ $employee->user->email }}
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-id-badge me-2"> </i>
                                        <strong class="me-2">DNI: </strong> {{ $employee->dni }}
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-phone me-2"> </i>
                                        <strong class="me-2">Celular: </strong> {{ $employee->phone }}
                                    </li>
                                    @if ($employee->birthdate)
                                        <li class="list-group-item">
                                            <i class="fas fa-birthday-cake me-2"> </i>
                                            <strong class="me-2">Fecha de Nacimiento: </strong>
                                            {{ $employee->birthdate->format('d/m/Y') }}
                                        </li>
                                    @endif
                                    @if ($employee->address)
                                        <li class="list-group-item">
                                            <i class="fas fa-map-marker-alt me-2"> </i>
                                            <strong class="me-2">Dirección: </strong> {{ $employee->address }} -
                                            {{ $employee->city }}
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
    <script>
        console.log('Hi!');
    </script>
@stop
