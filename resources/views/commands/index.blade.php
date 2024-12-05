@extends('adminlte::page')

@section('title', 'Comandas')

@section('content_header')
    <h1>Gestión de Comandas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Columna Pendientes -->
            <div class="col-md-4">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Pendientes</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($commands['Pendiente'] ?? [] as $command)
                            <div class="command-card cursor-pointer bg-white p-3 rounded shadow-sm mb-3 hover:shadow"
                                onclick="showCommandDetail({{ $command->id }})">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold">Mesa #{{ $command->order->table_id }}</span>
                                    <span class="text-muted small">{{ $command->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm mb-0">{{ $command->items->count() }} items</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Columna En Progreso -->
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">En Progreso</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($commands['En_Progreso'] ?? [] as $command)
                            <div class="command-card cursor-pointer bg-white p-3 rounded shadow-sm mb-3 hover:shadow"
                                onclick="showCommandDetail({{ $command->id }})">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold">Mesa #{{ $command->order->table_id }}</span>
                                    <span class="text-muted small">{{ $command->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm mb-0">{{ $command->items->count() }} items</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Columna Completadas -->
            <div class="col-md-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Completadas</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($commands['Completado'] ?? [] as $command)
                            <div class="command-card cursor-pointer bg-white p-3 rounded shadow-sm mb-3 hover:shadow"
                                onclick="showCommandDetail({{ $command->id }})">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold">Mesa #{{ $command->order->table_id }}</span>
                                    <span class="text-muted small">{{ $command->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm mb-0">{{ $command->items->count() }} items</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Detalles -->
    <div class="modal fade" id="commandDetailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de la Comanda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="commandDetailContent">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="updateStatusBtn">Actualizar Estado</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .command-card {
            transition: all 0.3s ease;
        }

        .command-card:hover {
            transform: translateY(-2px);
            cursor: pointer;
        }
    </style>
@stop

@section('js')
    <script>
        function showCommandDetail(commandId) {
            axios.get(`/commands/${commandId}`)
                .then(response => {
                    const command = response.data;
                    let html = `
                        <div class="command-detail">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4>Mesa #${command.order.table_id}</h4>
                                <span class="badge badge-${getStatusBadgeColor(command.status)}">${command.status}</span>
                            </div>
                            <div class="items-list mb-4">
                                ${command.items.map(item => `
                                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                        <div>
                                            <span class="font-weight-bold">${item.quantity}x</span>
                                            ${item.menu_item.name}
                                        </div>
                                        ${item.special_requests ? 
                                            `<small class="text-muted">${item.special_requests}</small>` : ''}
                                    </div>
                                `).join('')}
                            </div>
                            <div class="status-update mt-4">
                                <select class="form-control" id="newStatus">
                                    <option value="Pendiente" ${command.status === 'Pendiente' ? 'selected' : ''}>Pendiente</option>
                                    <option value="En_Progreso" ${command.status === 'En_Progreso' ? 'selected' : ''}>En Progreso</option>
                                    <option value="Completado" ${command.status === 'Completado' ? 'selected' : ''}>Completado</option>
                                    <option value="Cancelado" ${command.status === 'Cancelado' ? 'selected' : ''}>Cancelado</option>
                                </select>
                                <textarea class="form-control mt-2" id="statusNotes" placeholder="Notas adicionales..."></textarea>
                            </div>
                        </div>
                    `;
                    $('#commandDetailContent').html(html);
                    $('#commandDetailModal').modal('show');
                    
                    // Guardar el ID de la comanda actual
                    $('#updateStatusBtn').data('commandId', commandId);
                });
        }

        // Agregar manejador para el botón de actualizar
        $('#updateStatusBtn').click(function() {
            const commandId = $(this).data('commandId');
            const newStatus = $('#newStatus').val();
            const notes = $('#statusNotes').val();

            axios.patch(`/commands/${commandId}/status`, {
                status: newStatus,
                notes: notes
            })
            .then(response => {
                if(response.data.success) {
                    // Cerrar modal y recargar página
                    $('#commandDetailModal').modal('hide');
                    location.reload();
                    // Opcional: Mostrar notificación de éxito
                    toastr.success('Estado actualizado correctamente');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('Error al actualizar el estado');
            });
        });

        function getStatusBadgeColor(status) {
            const colors = {
                'Pendiente': 'warning',
                'En_Progreso': 'info',
                'Completado': 'success',
                'Cancelado': 'danger'
            };
            return colors[status] || 'secondary';
        }
    </script>
@stop
