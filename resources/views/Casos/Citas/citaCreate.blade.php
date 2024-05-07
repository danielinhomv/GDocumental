@extends('adminlte::page')

@section('title', 'Crear Cita')

@section('content_header')
    <img src="/storage/cita.png" alt="">
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nueva Cita</h3>
            </div>

            <div class="card-body">
                <form id="cita-form" action="{{ route('citas.store', $caso_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="descripcion">Nombre</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" rows="3"
                            placeholder="Nombre de la cita" required></input>
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control" rows="3" name='nota_adicional' placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Cita</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        console.log('hola!');
    </script>
@stop
