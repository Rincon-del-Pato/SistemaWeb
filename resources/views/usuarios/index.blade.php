@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
@stop

@section('content')
    <div class="container px-4 mx-auto">
        <h1 class="mb-6 text-3xl font-semibold">Usuarios</h1>

        <form action="{{ route('usuarios.index') }}" method="GET">
            <div class="flex flex-col justify-between gap-4 mb-6 md:flex-row">
                <div class="flex-1">
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="flex-1 md:max-w-md">
                            <div class="flex">
                                <input type="text" name="search" 
                                    class="w-full border-gray-300 rounded-l focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                    placeholder="Buscar usuarios..."
                                    value="{{ request('search') }}">
                                <button class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-r hover:bg-gray-200">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        @if (request('search'))
                            <div>
                                <a href="{{ route('usuarios.index') }}" 
                                   class="inline-flex items-center px-4 py-2 text-red-600 bg-red-100 border border-red-200 rounded-md hover:bg-red-200">
                                    Eliminar búsqueda
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <a href="{{ route('usuarios.create') }}" 
                       class="inline-flex items-center px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        <i class="mr-2 fas fa-plus"></i> Agregar Usuario
                    </a>
                </div>
            </div>
        </form>

        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Nº</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Usuario</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Rol</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($usuarios as $usuario)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $usuario->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @foreach ($usuario->roles as $rol)
                                        <span class="px-2 py-1 mr-2 text-sm text-blue-800 bg-blue-100 rounded-full">
                                            {{ $rol->description }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="flex justify-center gap-2">
                                        <a href="{{ route('usuarios.edit', $usuario) }}" 
                                           class="px-2 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-2 py-1 text-white bg-red-500 rounded hover:bg-red-600"
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-4 mt-4 md:flex-row">
            <div class="text-sm text-gray-600">
                Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} usuarios
            </div>

            <nav>
                <ul class="flex">
                    <li class="{{ $usuarios->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <a href="{{ $usuarios->previousPageUrl() }}" 
                           class="px-3 py-2 bg-white border rounded-l hover:bg-gray-50 {{ $usuarios->onFirstPage() ? 'pointer-events-none' : '' }}">
                            &laquo; Anterior
                        </a>
                    </li>

                    @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                        <li>
                            <a href="{{ $usuarios->url($i) }}" 
                               class="px-3 py-2 border-t border-b {{ $i == $usuarios->currentPage() ? 'bg-blue-50 text-blue-600' : 'bg-white hover:bg-gray-50' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <li class="{{ !$usuarios->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <a href="{{ $usuarios->nextPageUrl() }}" 
                           class="px-3 py-2 bg-white border rounded-r hover:bg-gray-50 {{ !$usuarios->hasMorePages() ? 'pointer-events-none' : '' }}">
                            Siguiente &raquo;
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
