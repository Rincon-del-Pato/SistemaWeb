@extends('adminlte::page')

@section('title', 'Dashboard Analytics')

@section('content_header')
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <iframe src="https://xyiu735dvkf4gagvta3rye.streamlit.app/" frameborder="0" width="100%" height="800px" style="overflow: hidden;"></iframe>
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
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                window.open('https://rincon-del-pato.github.io/Manual/', '_blank');
            }
        });
    </script>
@stop
