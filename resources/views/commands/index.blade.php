@extends('adminlte::page')

@section('title', 'Comandas')

@section('content_header')
    <h1>Comandas</h1>
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
                                    @if($command->order)
                                        @php
                                            $orderType = $command->order->order_type->value;
                                        @endphp
                                        @switch($orderType)
                                            @case('Local')
                                                <span class="font-weight-bold">
                                                    Mesa #{{ $command->order->table ? $command->order->table->table_number : 'N/A' }}
                                                </span>
                                                @break
                                            @case('ParaLlevar')
                                                <span class="font-weight-bold">
                                                    <i class="fas fa-shopping-bag mr-1"></i> Para Llevar
                                                </span>
                                                @break
                                            @case('Delivery')
                                                <span class="font-weight-bold">
                                                    <i class="fas fa-motorcycle mr-1"></i> Delivery
                                                </span>
                                                @break
                                            @default
                                                <span class="font-weight-bold">Tipo: {{ $orderType }}</span>
                                        @endswitch
                                    @else
                                        <span class="font-weight-bold">Orden no disponible</span>
                                    @endif
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
                                    @if($command->order)
                                        @php
                                            $orderType = $command->order->order_type->value;
                                        @endphp
                                        @switch($orderType)
                                            @case('Local')
                                                <span class="font-weight-bold">
                                                    Mesa #{{ $command->order->table ? $command->order->table->table_number : 'N/A' }}
                                                </span>
                                                @break
                                            @case('ParaLlevar')
                                                <span class="font-weight-bold">
                                                    <i class="fas fa-shopping-bag mr-1"></i> Para Llevar
                                                </span>
                                                @break
                                            @case('Delivery')
                                                <span class="font-weight-bold">
                                                    <i class="fas fa-motorcycle mr-1"></i> Delivery
                                                </span>
                                                @break
                                            @default
                                                <span class="font-weight-bold">Tipo: {{ $orderType }}</span>
                                        @endswitch
                                    @else
                                        <span class="font-weight-bold">Orden no disponible</span>
                                    @endif
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
                                    @if($command->order)
                                        @php
                                            $orderType = $command->order->order_type->value;
                                        @endphp
                                        @switch($orderType)
                                            @case('Local')
                                                <span class="font-weight-bold">
                                                    Mesa #{{ $command->order->table ? $command->order->table->table_number : 'N/A' }}
                                                </span>
                                                @break
                                            @case('ParaLlevar')
                                                <span class="font-weight-bold">
                                                    <i class="fas fa-shopping-bag mr-1"></i> Para Llevar
                                                </span>
                                                @break
                                            @case('Delivery')
                                                <span class="font-weight-bold">
                                                    <i class="fas fa-motorcycle mr-1"></i> Delivery
                                                </span>
                                                @break
                                            @default
                                                <span class="font-weight-bold">Tipo: {{ $orderType }}</span>
                                        @endswitch
                                    @else
                                        <span class="font-weight-bold">Orden no disponible</span>
                                    @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Función para refrescar las comandas cada 30 segundos
        setInterval(function() {
            if (!$('#commandDetailModal').hasClass('show')) {
                location.reload();
            }
        }, 30000);

        let currentCommandId; // Declarar variable global al inicio

        function showCommandDetail(commandId) {
            currentCommandId = commandId; // Asignar el ID al inicio de la función
            axios.get(`/commands/${commandId}`)
                .then(response => {
                    console.log('Response:', response.data);
                    const command = response.data;
                    
                    let orderTypeDisplay = '';
                    let additionalInfo = '';
                    
                    switch(command.order.type) {
                        case 'Local':
                            orderTypeDisplay = `Mesa #${command.order.info.table_number}`;
                            break;
                        case 'ParaLlevar':
                            orderTypeDisplay = `<i class="fas fa-shopping-bag mr-1"></i> Para Llevar`;
                            additionalInfo = command.order.info.special_instructions ? 
                                `<p class="text-sm text-gray-600">Instrucciones: ${command.order.info.special_instructions}</p>` : '';
                            break;
                        case 'Delivery':
                            orderTypeDisplay = `<i class="fas fa-motorcycle mr-1"></i> Delivery`;
                            additionalInfo = `
                                <p class="text-sm text-gray-600">Cliente: ${command.order.info.customer_name}</p>
                                <p class="text-sm text-gray-600">Dirección: ${command.order.info.delivery_address}</p>
                                ${command.order.info.special_instructions ? 
                                    `<p class="text-sm text-gray-600">Instrucciones: ${command.order.info.special_instructions}</p>` : ''}
                            `;
                            break;
                    }

                    let actionButtons = '';
                    if (command.status === 'Pendiente') {
                        actionButtons = `
                            <button onclick="changeStatus(${commandId}, 'En_Progreso')" 
                                    class="btn btn-info btn-lg btn-block mb-2">
                                Iniciar Preparación
                            </button>`;
                    } else if (command.status === 'En_Progreso') {
                        actionButtons = `
                            <button onclick="changeStatus(${commandId}, 'Completado')" 
                                    class="btn btn-success btn-lg btn-block mb-2">
                                Marcar como Completado
                            </button>`;
                    }

                    let html = `
                        <div class="command-detail">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h4>${orderTypeDisplay}</h4>
                                    ${additionalInfo}
                                </div>
                                <span class="badge badge-${getStatusBadgeColor(command.status)}">${command.status}</span>
                            </div>
                            <div class="items-list mb-4">
                                ${command.order.items.map(item => `
                                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                        <div>
                                            <span class="font-weight-bold">${item.quantity}x</span>
                                            ${item.menu_item.name}
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                            <div class="status-controls mt-4">
                                ${actionButtons}
                            </div>
                        </div>
                    `;
                    
                    $('#commandDetailContent').html(html);
                    $('#commandDetailModal').modal('show');
                    currentCommandId = commandId; // Variable global para mantener el ID actual
                })
                .catch(error => {
                    console.error('Error detallado:', error.response || error);
                    toastr.error('Error al cargar los detalles de la comanda');
                });
        }

        function changeStatus(commandId, newStatus) {
            console.log('Cambiando estado:', { commandId, newStatus }); // Debug log

            const loadingBtn = Swal.fire({
                title: 'Actualizando...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            axios.patch(`/commands/${commandId}/status`, {
                status: newStatus
            })
            .then(response => {
                console.log('Respuesta:', response.data); // Debug log
                loadingBtn.close();
                
                if (response.data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Estado actualizado',
                        text: `Nuevo estado: ${newStatus}`,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#commandDetailModal').modal('hide');
                        location.reload();
                    });
                } else {
                    throw new Error(response.data.message);
                }
            })
            .catch(error => {
                console.error('Error completo:', error); // Debug log
                loadingBtn.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.response?.data?.message || 'No se pudo actualizar el estado'
                });
            });
        }

        function getStatusBadgeColor(status) {
            const colors = {
                'Pendiente': 'warning',
                'En_Progreso': 'info',
                'Completado': 'success',
                'Cancelado': 'danger'
            };
            return colors[status] || 'secondary';
        }

        // Agregar manejador de F1
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
            }
        });
    </script>
@stop
