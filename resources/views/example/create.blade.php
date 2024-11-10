@extends('adminlte::page')

@section('title', '')

@section('content_header')
    <h1 class="text-3xl font-bold text-gray-800">Crear </h1>
@stop

@section('content')
<section class="w-full">
    <div class="flex flex-col">
        <div class="w-full">
            @includeif('partials.errors')

            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <span class="text-xl font-semibold text-gray-800"> Usuario</span>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('usuarios.store') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        @include('usuarios.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
    @vite('resources/css/app.css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
