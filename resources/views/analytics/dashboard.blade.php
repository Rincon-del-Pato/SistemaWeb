@extends('adminlte::page')

@section('title', 'Dashboard Analytics')

@section('content_header')
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <iframe id="dashboardFrame" src="http://localhost:8501" frameborder="0" width="100%" height="800px" style="overflow: hidden;"></iframe>
        </div>
    </div>
@stop

@section('css')
    <style>
        iframe {
            border: none;
            border-radius: 4px;
        }
    </style>
@stop

@section('js')
    <script>
        // Verificar disponibilidad de URL local
        function checkUrlAvailability() {
            fetch('http://localhost:8501', { mode: 'no-cors' })
                .catch(() => {
                    // Si falla, cambiar a URL alternativa
                    document.getElementById('dashboardFrame').src = 'https://xyiu735dvkf4gagvta3rye.streamlit.app/';
                });
        }

        // Ejecutar verificación cuando carga la página
        window.addEventListener('load', checkUrlAvailability);

        // Mantener el atajo de teclado F1
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
            }
        });
    </script>
@stop
