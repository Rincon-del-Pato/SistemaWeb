@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
@stop

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-6">Empleados</h1>

        <form action="{{ route('employees.index') }}" method="GET">
            <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                <div class="w-full md:w-2/3">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="relative w-full md:w-80">
                            <div class="flex">
                                <input type="text" name="search"
                                    class="block w-full pl-4 pr-3 py-2.5 text-sm text-gray-900 bg-gray-50 rounded-l-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Buscar empleados..."
                                    value="{{ request('search') }}">
                                <button type="submit"
                                    class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-r-lg border border-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        @if (request('search'))
                            <a href="{{ route('employees.index') }}"
                                class="inline-flex items-center px-3 py-2.5 text-sm font-medium rounded-lg border border-red-300 text-red-700 bg-white hover:bg-red-50 focus:ring-2 focus:ring-red-200">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('employees.create') }}"
                        class="inline-flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        <i class="fas fa-plus mr-2"></i>
                        Agregar Empleado
                    </a>
                </div>
            </div>
        </form>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nº</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Celular</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($employees as $employee)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $employee->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $employee->user()->first()->profile_photo_path) }}"
                                            class="h-10 w-10 rounded-full mr-3" alt="{{ $employee->user()->first()->name }}">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $employee->user()->first()->name }} {{ $employee->lastname }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $employee->user()->first()->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $employee->dni }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $employee->phone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $employee->user->getRoleNames()->implode(', ') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="flex justify-center space-x-2">
                                        <a href="{{ route('employees.edit', $employee) }}"
                                            class="p-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('employees.show', $employee) }}"
                                            class="p-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                                            onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
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

        <div class="mt-4 flex flex-col sm:flex-row justify-between items-center">
            <div class="text-sm text-gray-700">
                Mostrando {{ $employees->firstItem() }} a {{ $employees->lastItem() }} de {{ $employees->total() }} registros
            </div>

            <nav class="mt-4 sm:mt-0">
                <ul class="flex space-x-1">
                    <li class="{{ $employees->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <a href="{{ $employees->previousPageUrl() }}"
                            class="px-3 py-2 bg-white border rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            &laquo; Anterior
                        </a>
                    </li>

                    @for ($i = 1; $i <= $employees->lastPage(); $i++)
                        <li>
                            <a href="{{ $employees->url($i) }}"
                                class="px-3 py-2 {{ $i == $employees->currentPage() ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} border rounded-md text-sm font-medium hover:bg-gray-50">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <li class="{{ !$employees->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <a href="{{ $employees->nextPageUrl() }}"
                            class="px-3 py-2 bg-white border rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Siguiente &raquo;
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@stop

@section('css')
    {{-- Aquí puedes agregar estilos adicionales si es necesario --}}
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
