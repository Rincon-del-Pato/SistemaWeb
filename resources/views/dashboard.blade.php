@extends('adminlte::page')


@section('content_header')
    <h1 ><i class="fas fa-utensils"></i>
    </i>BIENVENIDOS</h1>

@stop

@section('content')
    <div class="text-center mb-4">
        <img src="vendor/adminlte/dist/img/Fondo1.jpeg" alt="logo" style="width: 1150px; height: 500px;">
    </div>
@stop




@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
