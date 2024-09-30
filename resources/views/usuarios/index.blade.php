@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Lista de Empleados</h1>
@stop

@section('content')

    <a href="roles/create" class="btn btn-primary mb-3">CREAR</a>

    <table id="empleados" class=" table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->name}}  </td>
                    <td>{{$usuario->email}}  </td>
                    <td>
                        @foreach ($usuario->roles as $rol)
                            {{$rol->description}}
                        @endforeach

                    </td>


                    <td>
                        <form action="{{route('roles.destroy',$rol)}}" method="POST">
                            <a href="{{route('roles.edit',$rol)}}" class="btn btn-info">Editar</a>
                            <a href="{{route('roles.show',$rol)}}" class="btn btn-info">Ver</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
