@extends('adminlte::page')

@section('title', 'Rol')

@section('content')
<div class="p-4 container-fluid">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Crear Rol</h1>
            <p class="mt-1 text-sm text-gray-600">Define un nuevo rol y asigna sus permisos correspondientes</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <form method="POST" action="{{ route('roles.store') }}" role="form">
                @csrf
                @include('roles.form')
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

@section('js')
    <script> console.log('Hi!'); </script>
@stop
