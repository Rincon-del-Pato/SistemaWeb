@extends('adminlte::page')

@section('title', 'Dashboard Analytics')

@section('content_header')
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <iframe src="http://localhost:8501" frameborder="0" width="100%" height="800px" style="overflow: hidden;"></iframe>
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
