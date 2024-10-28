@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    {{-- <h1>Crear producto</h1> --}}
@stop

@section('content')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 mt-4">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="mb-0 mt-0">Crear producto</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('products.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
