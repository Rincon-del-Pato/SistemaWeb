
@extends('adminlte::page')

@section('title', 'Editar Orden')

@section('content_header')
    <h1>Agregar Items a la Orden #{{ $order->id }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Información de la orden actual -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orden Actual</h3>
                </div>
                <div class="card-body">
                    <p><strong>Mesa:</strong> #{{ $order->table->id }}</p>
                    <p><strong>Total Actual:</strong> ${{ number_format($order->total, 2) }}</p>
                    <div class="items-actuales">
                        <h5>Items Ordenados:</h5>
                        @foreach($order->orderItems as $item)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>{{ $item->quantity }}x {{ $item->menuItem->name }}</span>
                                <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario para agregar nuevos items -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Agregar Nuevos Items</h3>
                </div>
                <div class="card-body">
                    <form id="addItemsForm">
                        @csrf
                        <div class="form-group">
                            <label>Categoría</label>
                            <select class="form-control" id="category">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="items-container">
                            <!-- Aquí van los items del menú -->
                        </div>

                        <div class="selected-items mt-4">
                            <h5>Items Seleccionados</h5>
                            <!-- Aquí van los items seleccionados -->
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Agregar a la Orden</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    // Similar al create.blade.php pero adaptado para update
    $('#addItemsForm').submit(function(e) {
        e.preventDefault();
        
        axios.patch(`/orders/${@json($order->id)}`, {
            items: getSelectedItems()
        })
        .then(response => {
            if(response.data.success) {
                window.location.href = '/orders';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar la orden');
        });
    });

    // Agregar resto de funciones necesarias para la selección de items
</script>
@stop