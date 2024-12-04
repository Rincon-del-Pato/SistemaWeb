
@extends('adminlte::page')

@section('title', 'Abastecer Inventario')

@section('content')
<div class="container-fluid">
    <div class="p-4">
        <div class="mb-4 bg-white rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">Abastecer Inventario</h1>
                <p class="mt-1 text-sm text-gray-600">
                    Artículo: {{ $item->name }} | Stock Actual: {{ $item->quantity }} {{ $item->unit->unit_name }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <form action="{{ route('inventory.store-supply', $item->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Cantidad a Abastecer
                        </label>
                        <input type="number" name="quantity_change" required min="1"
                               class="block w-full p-2.5 border rounded-lg"
                               placeholder="Ingrese la cantidad">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Detalles del Abastecimiento
                        </label>
                        <textarea name="notes" required
                                  class="block w-full p-2.5 border rounded-lg"
                                  placeholder="Ej: Compra de nuevo stock, Reposición mensual, etc."
                                  rows="3"></textarea>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('inventory.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded-lg">
                            Confirmar Abastecimiento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop