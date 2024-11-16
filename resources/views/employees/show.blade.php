@extends('adminlte::page')

@section('title', 'Detalle del empleado')

@section('content')
<div class="p-4 container-fluid">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Información del Empleado</h1>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-12">
                <!-- Columna de foto y nombre -->
                <div class="md:col-span-4">
                    <div class="text-center">
                        @if ($employee->user->profile_photo_path)
                            <img src="{{ asset('storage/' . $employee->user->profile_photo_path) }}"
                                alt="{{ $employee->lastname }} {{ $employee->user->name }}"
                                class="object-cover w-48 h-48 mx-auto mb-4 rounded-full">
                        @else
                            <div class="flex items-center justify-center w-48 h-48 mx-auto mb-4 text-4xl font-bold text-gray-600 bg-gray-300 rounded-full">
                                {{ substr($employee->user->name, 0, 1) }}{{ substr($employee->lastname, 0, 1) }}
                            </div>
                        @endif
                        <h2 class="text-2xl font-bold text-gray-900">{{ $employee->lastname }} {{ $employee->user->name }}</h2>
                        <p class="mb-2 text-gray-600">{{ $employee->age }} años</p>
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                            {{ $employee->user->getRoleNames()->implode(', ') }}
                        </span>
                    </div>
                </div>

                <!-- Columna de información -->
                <div class="md:col-span-8">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div class="p-4 rounded-lg bg-gray-50">
                                <p class="text-sm text-gray-500">Número de ID</p>
                                <p class="font-medium">{{ $employee->id }}</p>
                            </div>
                            <div class="p-4 rounded-lg bg-gray-50">
                                <p class="text-sm text-gray-500">Correo Electrónico</p>
                                <p class="font-medium">{{ $employee->user->email }}</p>
                            </div>
                            <div class="p-4 rounded-lg bg-gray-50">
                                <p class="text-sm text-gray-500">DNI</p>
                                <p class="font-medium">{{ $employee->dni }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="p-4 rounded-lg bg-gray-50">
                                <p class="text-sm text-gray-500">Teléfono</p>
                                <p class="font-medium">{{ $employee->phone }}</p>
                            </div>
                            @if ($employee->birthdate)
                                <div class="p-4 rounded-lg bg-gray-50">
                                    <p class="text-sm text-gray-500">Fecha de Nacimiento</p>
                                    <p class="font-medium">{{ $employee->birthdate->format('d/m/Y') }}</p>
                                </div>
                            @endif
                            @if ($employee->address)
                                <div class="p-4 rounded-lg bg-gray-50">
                                    <p class="text-sm text-gray-500">Dirección</p>
                                    <p class="font-medium">{{ $employee->address }} - {{ $employee->city }}</p>
                                </div>
                            @endif
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
    </style>
@stop
