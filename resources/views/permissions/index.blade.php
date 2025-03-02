@extends('adminlte::page')

@section('title', 'Permisos')

@section('content_header')
    <h1>Lista de Permisos</h1>
@stop

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Permissions') }}
                            </span>

                             <div class="float-right">

                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        <th>Descripcion</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($permissions as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>{{ $role->name }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
            }
        });
    </script>
@stop
