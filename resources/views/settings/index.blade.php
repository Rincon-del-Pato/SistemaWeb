@extends('adminlte::page')

@section('title', 'Configuraciones')

@section('content_header')
    <h1>Configuración del Restaurante</h1>
@stop

@section('content')

<div class="p-6">
    @if($settings)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Información General</h3>
                <ul class="space-y-2">
                    <li><strong>Nombre:</strong> {{ $settings->name }}</li>
                    <li><strong>RUC:</strong> {{ $settings->ruc }}</li>
                    <li><strong>Dirección:</strong> {{ $settings->address }}</li>
                    <li><strong>Teléfono:</strong> {{ $settings->phone }}</li>
                    <li><strong>Email:</strong> {{ $settings->email }}</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Logo</h3>
                @if($settings->logo)
                    <img src="" alt="Logo del Restaurante" class="max-w-full h-auto rounded-lg shadow-md">
                @else
                    <p class="text-gray-500 italic">No se ha cargado un logo</p>
                @endif
            </div>
        </div>
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Mesas</h3>
            <p class="text-xl font-bold text-blue-600">Total de mesas:</p>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Editar Configuración
            </a>
        </div>
    @else
        <div class="text-center py-8">
            {{-- <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"> --}}
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay información del restaurante</h3>
            <p class="mt-1 text-sm text-gray-500">Comienza agregando la información de tu restaurante.</p>
            <div class="mt-6">
                <a href="" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-black bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{-- <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg> --}}
                    Agregar Información del Restaurante
                </a>
            </div>
        </div>
    @endif
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
