@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1 class="text-2xl font-bold text-gray-800">Crear empleados</h1>
@stop

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @includeif('partials.errors')

            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('employees.store') }}" role="form" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @include('employees.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Podemos eliminar el CSS de Bootstrap si ya no lo necesitamos --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
