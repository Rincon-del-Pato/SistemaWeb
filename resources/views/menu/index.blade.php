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
                    <a href="{{ route('menu.create') }}"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-700 rounded-lg hover:bg-blue-800">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <!-- Tabs de categorías -->
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px">
                        @foreach ($categories as $index => $category)
                            <li class="me-2">
                                <a href="#"
                                    class="tab-button inline-block p-4 border-b-2 rounded-t-lg {{ $index === 0 ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                                    onclick="changeTab('category-{{ $category->id }}', event)"
                                    role="tab">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contenido de las tabs -->
                <div class="mt-6">
                    @forelse ($categories as $index => $category)
                        <div id="category-{{ $category->id }}" class="tab-content {{ $index === 0 ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                @forelse ($products[$category->id] ?? [] as $product)
                                    <div class="overflow-hidden bg-white rounded-lg shadow">
                                        <div class="p-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div>
                                                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                                    @unless($product->available)
                                                        <span class="px-2 py-1 text-xs text-white bg-red-500 rounded">No disponible</span>
                                                    @endunless
                                                </div>
                                                <div class="flex gap-2">
                                                    <a href="{{ route('menu.edit', $product->id) }}"
                                                        class="text-blue-600 hover:text-blue-800">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('menu.show', $product->id) }}"
                                                        class="text-green-600 hover:text-green-800">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="mb-3 text-sm text-gray-600">{{ $product->description }}</p>

                                            <!-- Tamaños y precios -->
                                            <div class="space-y-2 mb-3">
                                                <h4 class="font-medium text-sm">Tamaños y precios:</h4>
                                                <div class="divide-y divide-gray-200">
                                                    @forelse ($product->sizes as $size)
                                                        <div class="flex justify-between items-center py-1 text-sm">
                                                            <div>
                                                                <span class="font-medium">{{ $size->size_name }}</span>
                                                                @if($size->volume && $size->unit)
                                                                    <span class="text-gray-500 text-xs">
                                                                        ({{ $size->volume }} {{ $size->unit->abbreviation ?? '' }})
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <span class="font-semibold">S/. {{ number_format($size->pivot->price, 2) }}</span>
                                                        </div>
                                                    @empty
                                                        <p class="text-sm text-gray-500">Sin tamaños disponibles</p>
                                                    @endforelse
                                                </div>
                                            </div>

                                            <!-- Ingredientes -->
                                            <div class="text-sm">
                                                <h4 class="font-medium text-sm mb-1">Ingredientes:</h4>
                                                <ul class="space-y-1">
                                                    @forelse ($product->inventoryItems as $item)
                                                        <li class="flex justify-between text-gray-600">
                                                            <span>{{ $item->name }}</span>
                                                            <span class="text-gray-500">
                                                                {{ number_format($item->pivot->quantity_needed_per_unit, 2) }}
                                                                {{ optional($item->unit)->abbreviation ?? 'unidad' }}
                                                            </span>
                                                        </li>
                                                    @empty
                                                        <li class="text-gray-500">Sin ingredientes registrados</li>
                                                    @endforelse
                                                </ul>
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
        function changeTab(tabId, event) {
            // Prevenir el comportamiento predeterminado del enlace
            if (event) {
                event.preventDefault();
            }

            // Ocultar todos los contenidos de las pestañas
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remover las clases activas de todas las pestañas
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-blue-600', 'border-blue-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Mostrar el contenido seleccionado
            const selectedContent = document.getElementById(tabId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }

            // Activar la pestaña seleccionada
            if (event && event.currentTarget) {
                event.currentTarget.classList.remove('border-transparent', 'text-gray-500');
                event.currentTarget.classList.add('text-blue-600', 'border-blue-600');
            }
        }

        // Inicializar la primera pestaña al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            const firstCategory = document.querySelector('.tab-button');
            if (firstCategory) {
                const categoryId = firstCategory.getAttribute('onclick').match(/category-\d+/)[0];
                changeTab(categoryId);
                firstCategory.classList.remove('border-transparent', 'text-gray-500');
                firstCategory.classList.add('text-blue-600', 'border-blue-600');
            }
        });

        // Agregar manejador de F1
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
            }
        });
    </script>
@endsection
