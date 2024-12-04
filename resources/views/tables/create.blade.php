@php
    use App\Enums\TableStatus;
@endphp

@extends('adminlte::page')

@section('title', 'Mesas')

@section('content')
<div class="p-4 container-fluid">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Panel de creación/edición - más estrecho -->
        <div class="lg:col-span-1">
            <div class="mb-4 bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">Crear Mesa</h1>
                    <p class="mt-1 text-sm text-gray-600">Define una nueva mesa</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <form method="POST" action="{{ route('tables.store') }}" role="form">
                        @csrf
                        @include('tables.form')
                    </form>
                </div>
            </div>
        </div>

        <!-- Panel de mesas existentes - más ancho -->
        <div class="lg:col-span-2">
            <div class="mb-4 bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Mesas Existentes</h2>
                    <p class="mt-1 text-sm text-gray-600">Distribución actual de mesas</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <!-- Contenedor con scroll -->
                    <div class="h-[calc(100vh-400px)] overflow-y-auto pr-2">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            @foreach($existingTables as $existingTable)
                            <div class="p-4 border rounded-lg {{ $existingTable->status->value === 'Disponible' ? 'border-green-200 bg-green-50' : ($existingTable->status->value === 'Ocupado' ? 'border-red-200 bg-red-50' : 'border-yellow-200 bg-yellow-50') }}">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-lg font-semibold">Mesa {{ $existingTable->table_number }}</span>
                                    <span class="inline-flex items-center">
                                        <i class="fas fa-circle text-{{ $existingTable->status->value === 'Disponible' ? 'green' : ($existingTable->status->value === 'Ocupado' ? 'red' : 'yellow') }}-500 mr-1"></i>
                                        <span class="text-sm">{{ $existingTable->status->value }}</span>
                                    </span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="mr-2 fas fa-users"></i>
                                    <span>{{ $existingTable->seating_capacity }} personas</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Resumen de mesas -->
                    <div class="grid grid-cols-3 gap-4 pt-4 mt-4 border-t">
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $existingTables->where('status', TableStatus::Disponible)->count() }}</div>
                                <div class="text-sm text-gray-600">Disponibles</div>
                            </div>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-red-600">{{ $existingTables->where('status', TableStatus::Ocupado)->count() }}</div>
                                <div class="text-sm text-gray-600">Ocupadas</div>
                            </div>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-600">{{ $existingTables->count() }}</div>
                                <div class="text-sm text-gray-600">Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .content-wrapper {
            background-color: #f8fafc;
        }
        /* Estilo para la barra de desplazamiento */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>
@stop
