@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
<div class="container-fluid p-4">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Editar Usuario</h1>
            <p class="mt-1 text-sm text-gray-600">Modifica la información del usuario y actualiza sus rol según sea necesario</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <form method="POST" action="{{ route('usuarios.update', $usuario) }}" role="form" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                @include('usuarios.form')
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
