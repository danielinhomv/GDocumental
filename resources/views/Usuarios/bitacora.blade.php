@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<img src="/storage/bitacora.png" alt="">

@stop

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Log list</h3>
            <div class="card-tools">
                <form role="form" action="{{ route('bitacoras.search') }}" method="POST"
                    class="input-group input-group-sm" style="width: 150px;">
                    @csrf
                    <input type="text" name="search" class="form-control float-right " placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap table table-bordered"">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Rol</th>
                        <th>Ip</th>
                        <th>Accion</th>
                        <th>Fecha</th>
                </thead>
                <tbody>
                        @if ($bitacoras->count() === 0)
                            <tr>
                                <td colspan="6" class="text-center">No se econtraron resultados</td>
                            </tr>
                        @else
                            @foreach ($bitacoras as $bitacora)
                                <tr>
                                    <td>{{ $bitacora->id }}</td>
                                    <td>{{ $bitacora->name }}</td>
                                    @if ($bitacora->rol==null)
                                    <td>empresa</td>
                                    @else
                                    <td>{{ $bitacora->rol }}</td>
                                    @endif
                                    <td>{{ $bitacora->ip }}</td>
                                    <td>{{ $bitacora->accion }}</td>
                                    <td>{{ $bitacora->fecha_hora }}</td>
                                    
                                </tr>
                            @endforeach
                        @endif
                </tbody>
            </table>
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
