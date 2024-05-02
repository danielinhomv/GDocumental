@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<img src="/storage/hombre_abogado.png" alt="" width="50">    
<h1>{{$abogado->name}}</h1>
@stop

@section('content')
<form>
    <div class="card-body">
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" value="{{$abogado->email}}"readonly>
        </div>
        
        <div class="form-group">
            <label>Nombre completo</label>
            <input type="text" class="form-control" value="{{$abogado->nombre_completo}}"readonly>
        </div>
        <div class="form-group">
            <label>Direccion</label>
            <input type="text" class="form-control" value="{{$abogado->direccion}} "readonly>
        </div>
        <div class="form-group">
            <label>Telefono</label>
            <input type="text" class="form-control"  value="{{$abogado->telefono}}" readonly>
        </div>
        <div class="form-group">
            <label>Nota adicional</label>
            <textarea class="form-control" rows="3" readonly>{{$abogado->nota_adicional}}</textarea>
        </div>
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
