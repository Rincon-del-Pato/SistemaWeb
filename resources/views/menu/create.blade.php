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
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-800 border border-red-200 rounded-lg bg-red-50">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                @csrf
                @include('menu.form')
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('menuItemForm', () => ({
                productType: '',
                sizes: [{}],
                inventoryItems: [{}],

                init() {
                    console.log('Form initialized with product type:', this.productType);
                },

                addSize() {
                    this.sizes.push({});
                },
                removeSize(index) {
                    if (this.sizes.length > 1) {
                        this.sizes.splice(index, 1);
                    }
                },
                addInventoryItem() {
                    this.inventoryItems.push({});
                },
                removeInventoryItem(index) {
                    if (this.inventoryItems.length > 1) {
                        this.inventoryItems.splice(index, 1);
                    }
                }
            }))
        })
    </script>
@endpush
