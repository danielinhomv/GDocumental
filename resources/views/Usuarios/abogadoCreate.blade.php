@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<img src="/storage/hombre_abogado.png" alt="">
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo abogado</h3>
            </div>
            <form role="form" action="{{ route('company_abogado_users.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" name="name" placeholder="benito">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="benito123@gmail.com">
                    </div>
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" class="form-control" name="nombre_completo"
                            placeholder="benito camelo algarañaz">
                    </div>
                    <div class="form-group">
                        <label>Carnet</label>
                        <input type="text" class="form-control" name="password" placeholder="13176537">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="direccion"
                            placeholder="barrio 22 de octubre-santa cruz">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" name="telefono" placeholder="72173408">
                    </div>
                    <div class="form-group">
                        <label>Nota adicional</label>
                        <textarea class="form-control" rows="3" name='nota_adicional' placeholder="Enter ..."></textarea>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Crear abogado</button>
                    </div>
            </form>
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
