@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show casos</h5>

            <div class="container mt-4">
                <div>
                    nombre del  Caso: {{ $caso->nombre }}
                </div>
                <div>
                    descripcion: {{ $caso->descripcion }}
                </div>
                <div>
                    Nombre del Abogado: {{ $abogado }}
                </div>
                <div>
                    Nombre del cliente: {{ $cliente }}
                </div>
                <div>
                    Estado: {{ $caso->estado }}
                </div>
                <div>
                    fecha Apertura: {{ $caso->fecha_apertura }}
                </div>


                <div class="mt-4">
                    <a href="{{ route('casos.edit', $caso->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('casos.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>

        </div>

    </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
