@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>crear nuevo caso</h1>
@stop

@section('content')
<!-- Button trigger modal -->
<form method="POST" action="{{ route('casos.store') }}">
    @csrf
<div class="box box-success">
    <div class="box-header with-border">
    <h3 class="box-title"></h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($result as $item)
                <option value = "{{ $item['id'] }}"> {{$item['nombre']}}</option>
            @endforeach
            </select>
         </div>

    <label>Nombre Del Caso</label>
    <input id="nombre" name="nombre" class="form-control input-lg" type="text" placeholder="caso">
    <br>
    <label>Descripcion</label>
    <input id="descripcion" name="descripcion" class="form-control" type="text" placeholder="descripcion">
    <br>
    <label> Nota Adiccional</label>
    <input id="nota_adicional" name="nota_adicional" class="form-control input-sm" type="text" placeholder="nota">
    </div>
    <button type="submit", class="btn btn-primary">Save user</button>
    <a href="{{ route('casos.index') }}" class="btn btn-default">Back</a>
    
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