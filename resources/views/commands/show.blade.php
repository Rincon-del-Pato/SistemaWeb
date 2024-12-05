@extends('adminlte::page')

@section('title', 'Detalle de Comanda')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Comanda #{{ $command->id }}</h1>
        </div>
        <div class="col-sm-6">
            <x-command-status-update :command="$command" />
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalles de la Orden</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Mesa:</strong> {{ $command->order->table->number }}</p>
                            <p><strong>Clientes:</strong> {{ $command->order->num_guests }}</p>
                            <p><strong>Hora:</strong> {{ $command->created_at->format('H:i') }}</p>
                        </div>
                    </div>

                    <h4 class="mt-4">Items:</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Plato</th>
                                    <th>Cantidad</th>
                                    <th>Notas Especiales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($command->items as $item)
                                    <tr>
                                        <td>{{ $item->menuItem->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->special_requests ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 class="mt-4">Historial de Estados:</h4>
                    <div class="timeline">
                        @foreach($command->logs()->orderByDesc('created_at')->get() as $log)
                            <div>
                                <i class="fas fa-clock bg-info"></i>
                                <div class="timeline-item">
                                    <span class="time">
                                        <i class="fas fa-clock"></i> 
                                        {{ $log->created_at->format('H:i') }}
                                    </span>
                                    <h3 class="timeline-header">{{ $log->new_status }}</h3>
                                    @if($log->notes)
                                        <div class="timeline-body">
                                            {{ $log->notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Aquí puedes agregar JavaScript personalizado
    </script>
@stop