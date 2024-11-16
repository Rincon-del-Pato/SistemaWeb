@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
<div class="p-4 container-fluid">
    <div class="mb-4 bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Menú de Productos</h1>
                    <p class="mt-1 text-sm text-gray-600">Gestiona los productos del menú</p>
                </div>
                <a href="{{ route('menu-item-sizes.create') }}" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
                    <i class="fas fa-plus"></i> Agregar Producto
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <!-- Tabs de categorías -->
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px space-x-8">
                    @foreach ($categories as $index => $category)
                        <button class="px-1 py-4 text-sm font-medium {{ $index === 0 ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                            onclick="changeTab('category-{{ $category->id }}')">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </nav>
            </div>

            <!-- Contenido de las tabs -->
            <div class="mt-6">
                @forelse ($categories as $index => $category)
                    <div id="category-{{ $category->id }}" class="tab-content {{ $index === 0 ? '' : 'hidden' }}">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @forelse ($products->where('category_id', $category->id) as $product)
                                <div class="overflow-hidden bg-white rounded-lg shadow">
                                    <div class="p-4">
                                        <h3 class="mb-2 text-lg font-semibold">{{ $product->name }}</h3>
                                        <p class="mb-3 text-sm text-gray-600">{{ $product->description }}</p>
                                        <div class="space-y-1">
                                            @forelse ($product->sizes as $size)
                                                <div class="flex justify-between">
                                                    <span>{{ $size->size_name }}</span>
                                                    <span>S/. {{ number_format($size->pivot->price, 2) }}</span>
                                                </div>
                                            @empty
                                                <p class="text-sm text-gray-500">Sin tamaños disponibles</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="col-span-3 py-4 text-center text-gray-500">No hay productos en esta categoría</p>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-center text-gray-500">No hay categorías disponibles</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop

@push('scripts')
<script>
function changeTab(tabId) {
    // Ocultar todos los contenidos
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Mostrar el contenido seleccionado
    document.getElementById(tabId).classList.remove('hidden');
    
    // Actualizar estilos de las pestañas
    document.querySelectorAll('button').forEach(button => {
        button.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
        button.classList.add('text-gray-500');
    });
    
    // Activar la pestaña seleccionada
    document.querySelector(`button[data-target="#${tabId}"]`).classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
}
</script>
@endpush
