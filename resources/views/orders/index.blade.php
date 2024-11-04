@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content_header')
@stop

@section('content')
    <div class="p-4 container-fluid">
        <div class="row">
            <!-- Panel principal -->
            <div id="mainPanel" class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-success">{{ $tables->where('status', 'Disponible')->count() }}
                                    Libre</span>
                                <span class="badge bg-danger">{{ $tables->where('status', 'Ocupado')->count() }}
                                    Ocupado</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
                            @foreach ($tables as $table)
                                <div class="col d-flex"> <!-- Añadido d-flex -->
                                    <div class="card shadow-sm border {{ $table->status->value === 'Disponible' ? 'bg-green' : ($table->status->value === 'Ocupado' ? 'bg-danger' : 'bg-warning') }} {{ $table->status->value === 'Disponible' ? 'cursor-pointer' : '' }}"
                                        @if ($table->status->value === 'Disponible') onclick="selectTable({{ $table->id }}, {{ $table->capacity }}, '{{ $table->name }}')"
                                            role="button" @endif>
                                        <div class="card-body d-flex flex-column align-items-center p-3">
                                            <!-- Nombre de la mesa -->
                                            <h6 class="card-title fw-bold fs-5 mb-2">{{ $table->name }}</h6>

                                            <!-- Personal que atiende -->
                                            @if ($table->status->value !== 'Disponible' && $table->personal_id)
                                                <small class="text-muted mb-2 fs-6">
                                                    <i class="fas fa-user me-1"></i>
                                                    {{ $table->personal->name }}
                                                </small>
                                            @endif

                                            <!-- Imagen de mesa -->
                                            <div class="text-center">
                                                @if ($table->status->value === 'Disponible')
                                                    <img src="{{ asset('imagen/mesa-vacia.png') }}" alt="Mesa"
                                                        class="img-fluid w-75">
                                                @elseif ($table->status->value === 'Ocupado')
                                                    <img src="{{ asset('imagen/mesa-llena.png') }}" alt="Mesa"
                                                        class="img-fluid w-50 p-2">
                                                @else
                                                    <img src="{{ asset('imagen/mesa-reservada.png') }}" alt="Mesa"
                                                        class="img-fluid w-50 py-2">
                                                @endif
                                            </div>

                                            <!-- Capacidad -->
                                            <div class="d-flex align-items-center gap-2 mb-1 fs-6">
                                                <i class="fas fa-users"></i>
                                                <span>{{ $table->capacity }}</span>
                                            </div>

                                            <!-- Estado -->
                                            <div class="mb-1">
                                                <span class="fs-5 ">
                                                    {{ $table->status->value }}
                                                </span>
                                            </div>
                                            <!-- Eliminar la sección de botones -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel lateral -->
            <div id="sidePanel" class="col-md-3" style="display: none;">
                <div class="card" id="tableForm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 card-title"><span id="selectedTable">Ninguna</span></h5>
                    </div>
                    <div class="card-body">
                        <form id="capacityForm">
                            <input type="hidden" id="tableId">
                            <!-- Número de personas -->
                            <div class="mb-3">
                                <label for="peopleCount" class="form-label">Número de personas</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <input type="number" class="form-control" id="peopleCount" min="1" required>
                                </div>
                                <small class="text-muted">Capacidad máxima: <span id="maxCapacity"></span></small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="col-md-5 btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> <span class="ms-1">Confirmar</span>
                                </button>
                                <button type="button" class="col-md-5 btn btn-danger" aria-label="Close"
                                    onclick="closeSidePanel()">
                                    <i class="fas fa-ban"></i> <span class="ms-1">Cancelar</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .card {
            transition: transform 0.2s;
            border-radius: 10px;
        }

        .card.cursor-pointer {
            cursor: pointer;
        }

        .card.cursor-pointer:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@stop

@section('js')
    <script>
        function selectTable(tableId, capacity, tableName) {
            // Mostrar panel lateral
            const sidePanel = document.getElementById('sidePanel');
            sidePanel.style.display = 'block';

            // Ajustar el panel principal
            const mainPanel = document.getElementById('mainPanel');
            mainPanel.className = 'col-md-9';

            // Establecer valores del formulario
            document.getElementById('tableId').value = tableId;
            document.getElementById('maxCapacity').textContent = capacity;
            document.getElementById('peopleCount').max = capacity;
            document.getElementById('selectedTable').textContent = tableName;
        }

        function closeSidePanel() {
            // Ocultar panel lateral
            const sidePanel = document.getElementById('sidePanel');
            sidePanel.style.display = 'none';

            // Restaurar panel principal a ancho completo
            const mainPanel = document.getElementById('mainPanel');
            mainPanel.className = 'col-12';
        }

        document.getElementById('capacityForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const tableId = document.getElementById('tableId').value;
            const peopleCount = document.getElementById('peopleCount').value;

            window.location.href = `/orders/create/${tableId}?people_count=${peopleCount}`;
        });
    </script>
@stop
