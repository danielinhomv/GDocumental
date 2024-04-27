@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form role="form">
        <div class="card-body">
            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" class="form-control" id="Nombre_completo" placeholder="benito camelo algarañaz">
            </div>
            <div class="form-group">
                <label>Carnet</label>
                <input type="text" class="form-control" id="contraseña" placeholder="13176537">
            </div>
            <div class="form-group">
                <label>Direccion</label>
                <input type="text" class="form-control" id="direccion" placeholder="barrio 22 de octubre-santa cruz">
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" id="telefono" placeholder="72173408">
            </div>
            <div class="form-group">
                <label>Nota adicional</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
</form>
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
