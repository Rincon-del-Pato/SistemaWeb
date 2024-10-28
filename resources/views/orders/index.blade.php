@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    {{-- <h1>Lista de Categorías</h1> --}}
@stop

@section('content')
    <div class="p-4 container-fluid">
        <div class="row">
            <div class="col-md-9">
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
                        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                            @foreach ($tables as $table)
                                <div class="p-2 col">
                                    <div
                                        class="card h-100 {{ $table->status->value === 'Disponible' ? 'border-success' : 'border-danger' }}">
                                        <div class="p-2 text-center card-body">
                                            <!-- Nombre de la mesa -->
                                            <h6 class="mb-2 fw-bold">{{ $table->name }}</h6>

                                            <!-- Personal que atiende -->
                                            @if ($table->status->value !== 'Disponible' && $table->personal_id)
                                                <small class="mb-2 text-muted d-block">
                                                    <i class="fas fa-user me-1"></i>
                                                    {{ $table->personal->name }}
                                                </small>
                                            @endif

                                            <!-- Imagen de mesa -->
                                            <div class="mb-2">
                                                <img src="{{ asset('imagen/mesa-vacia.png') }}" alt="Mesa" class="img-fluid">
                                            </div>

                                            <!-- Capacidad -->
                                            <div class="gap-1 mb-2 d-flex justify-content-center align-items-center">
                                                <i class="fas fa-users small"></i>
                                                <span class="small"><i class="fas fa-users"></i> {{ $table->capacity }}</span>
                                            </div>

                                            <!-- Estado -->
                                            <div class="mb-2">
                                                @if ($table->status->value === 'Disponible')
                                                    <span class="text-success small fw-bold">LIBRE</span>
                                                @else
                                                    <span class="text-danger small fw-bold">OCUPADO</span>
                                                @endif
                                            </div>

                                            <!-- Botón -->
                                            @if ($table->status->value === 'Disponible')
                                                <button class="btn btn-primary btn-sm w-100"
                                                    onclick="selectTable({{ $table->id }}, {{ $table->capacity }})">
                                                    Seleccionar
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel lateral -->
            <div class="col-md-3">
                <div class="card" id="tableForm" style="display: none;">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Mesa seleccionada</h5>
                    </div>
                    <div class="card-body">
                        <form id="capacityForm">
                            <input type="hidden" id="tableId">
                            <!-- Personal -->
                            {{-- <div class="mb-3">
                                <label for="personalId" class="form-label">Personal</label>
                                <select class="form-select" id="personalId" required>
                                    <option value="">Seleccione personal</option>
                                    @foreach ($personal as $person)
                                        <option value="{{ $person->id }}">{{ $person->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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
                            <button type="submit" class="btn btn-primary w-100">
                                Confirmar
                            </button>
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
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@stop

@section('js')
    <script>
        function selectTable(tableId, capacity) {
            document.getElementById('tableForm').style.display = 'block';
            document.getElementById('tableId').value = tableId;
            document.getElementById('maxCapacity').textContent = capacity;
            document.getElementById('peopleCount').max = capacity;
        }

        document.getElementById('capacityForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const tableId = document.getElementById('tableId').value;
            const peopleCount = document.getElementById('peopleCount').value;
            const personalId = document.getElementById('personalId').value;

            try {
                const response = await fetch(`/tables/${tableId}/capacity`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        people_count: peopleCount,
                        personal_id: personalId
                    })
                });

                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.message || 'Error al actualizar la mesa');
                }

                window.location.reload();
            } catch (error) {
                alert(error.message);
            }
        });
    </script>
@stop
