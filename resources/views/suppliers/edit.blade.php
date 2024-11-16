
@extends('adminlte::page')

@section('title', 'Proveedor')

@section('content')
<div class="p-4 container-fluid">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Editar Proveedor</h1>
            <p class="mt-1 text-sm text-gray-600">Modifique los datos del proveedor</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <form method="POST" action="{{ route('suppliers.update', $supplier) }}" role="form">
                @method('PATCH')
                @csrf
                @include('suppliers.form')
            </form>
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