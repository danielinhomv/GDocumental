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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            nuevo cliente
        </button>
          
        <div class="form-group">
            <label>Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
            @foreach ($result as $item)
                <option value = "{{ $item['id'] }}"> {{$item['name']}}</option>
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
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar nuevo cliente</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form action="{{ route('casos.cliente-store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                 <div class="mb-3">
                    <label for="name" class="form-label"> Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nombre_completo" class="form-label"> Nombre completo:</label>
                    <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"> correo:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"> carnet:</label>
                    <input type="text" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label"> direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label"> telefono:</label>
                    <input type="number" name="telefono" id="telefono" class="form-control" required>
                </div> 
                <div class="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                 </div>        
        
            </form>
        </div>

      </div>
    </div>
  </div>

@stop
<script></script>

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity ="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@stop



