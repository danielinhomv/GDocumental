@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <img src="/storage/hombre_abogado.png" alt="">
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar abogado</h3>
            </div>
            <form role="form" action="{{ route('company_abogado_users.update', $abogado->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" class="form-control" name="nombre_completo"
                            value="{{ $abogado->nombre_completo }}">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="direccion" value="{{ $abogado->direccion }}">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ $abogado->telefono }}">
                    </div>
                    <div class="form-group">
                        <label>Nota adicional</label>
                        <textarea class="form-control" rows="3" name="nota_adicional">{{ $abogado->nota_adicional }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
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
