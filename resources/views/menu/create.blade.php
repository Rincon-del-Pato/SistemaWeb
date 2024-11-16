@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content')
<div x-data="menuItemForm()" class="p-4 container-fluid">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Crear Producto</h1>
            <p class="mt-1 text-sm text-gray-600">Agrega un nuevo producto al menú</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <form method="POST" action="{{ route('menu-item-sizes.create') }}" enctype="multipart/form-data">
                @csrf
                @include('menu.form')
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
