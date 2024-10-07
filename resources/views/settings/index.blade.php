@extends('adminlte::page')

@section('title', 'Configuraciones')

@section('content_header')
    <h1>Configuración del Restaurante</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if ($settings)
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mb-4 h4">Información General</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Nombre:</strong> {{ $settings->name }}</li>
                                <li class="mb-2"><strong>RUC:</strong> {{ $settings->ruc }}</li>
                                <li class="mb-2"><strong>Dirección:</strong> {{ $settings->address }}</li>
                                <li class="mb-2"><strong>Teléfono:</strong> {{ $settings->phone }}</li>
                                <li class="mb-2"><strong>Email:</strong> {{ $settings->email }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3 class="mb-4 h4">Logo</h3>
                            @if ($settings->logo)
                                <img src="{{ asset('imagen/logo.png') }}" alt="Logo del Restaurante"
                                    class="rounded shadow-sm img-fluid w-50">
                            @else
                                <p class="text-muted fst-italic">No se ha cargado un logo</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="" class="btn btn-primary">
                            Editar Configuración
                        </a>
                    </div>
                @else
                    <div class="py-5 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                            class="mb-4 bi bi-folder-plus text-secondary" viewBox="0 0 16 16">
                            <path
                                d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                            <path
                                d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <h3 class="mb-2 h5">No hay información del restaurante</h3>
                        <p class="mb-4 text-muted">Comienza agregando la información de tu restaurante.</p>
                        <a href="{{ route('admin.settings.create') }}" class="btn btn-primary">
                            Agregar información del restaurante
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
