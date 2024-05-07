@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <img src="/storage/admin.png" alt="">
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div>
                <div class="card-header card bg-gradient-primary">
                    <h3 class="card-title">Configuración</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('reporte.ver') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="tipo_reporte" name="tipo_reporte">Tipo de Reporte</label>
                            <select class="form-control" id="tipo_reporte" name="tipo_reporte">
                                <option value="clientes">Clientes</option>
                                <option value="casos">Casos</option>
                                <option value="citas">Citas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio" name="fecha_inicio">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio">
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin" name="fecha_fin">Fecha y Hora de Fin</label>
                            <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin">
                        </div>
                        <div id="opciones_citas" style="display: none;">
                            <div class="form-group">
                                <label for="filtro_citas">Filtrar Citas</label>
                                <select class="form-control" id="filtro_citas" name="filtro_citas">
                                    <option value="todas">Todas las Citas</option>
                                    <option value="por_abogado">Por Abogado</option>
                                </select>
                            </div>
                        </div>
                        <div id="opciones_cliente_casos" style="display: block;">
                            <div class="form-group">
                                <label for="filtro_cliente_casos">Filtrar</label>
                                <select class="form-control" id="filtro_cliente_casos" name="filtro_cliente_casos">
                                    <option value="todas">Todas</option>
                                    <option value="por_abogado">Por Abogado</option>
                                </select>
                            </div>
                        </div>

                        <div id="opciones_abogado" style="display: none;">
                            <div class="form-group">
                                <label for="abogado">Abogado</label>
                                <select class="form-control" id="abogado" name="abogado">
                                    <option value="0">Seleccionar Abogado</option>
                                    @foreach ($abogados as $abogado)
                                        <option value={{ $abogado->id }}>{{ $abogado->email }}</option>
                                    @endforeach
                                    <!-- Agregar más opciones según sea necesario -->
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Visualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div>
                <div class="card-header bg-gradient-warning">
                    <h3 class="card-title">Reportes</h3>
                </div>
                <div class="card-body">
                    <div class="mt-3">
                        <div class="table-responsive">
                             <p>No hay nada que mostrar.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Agrega aquí tus estilos personalizados -->
    <style>
        /* Estilos adicionales */
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fadeIn {
            animation-name: fadeIn;
        }
    </style>
@stop

@section('js')
    <script>
        // Mostrar u ocultar opciones de citas según el tipo de reporte seleccionado
        document.getElementById('tipo_reporte').addEventListener('change', function() {
            var filtroCitas = this.value;

            if (filtroCitas === 'citas') {
                document.getElementById('opciones_citas').style.display = 'block';
                document.getElementById('opciones_cliente_casos').style.display = 'none';
                document.getElementById('opciones_abogado').style.display = 'none';
            } else {
                if (filtroCitas === 'casos') {
                    document.getElementById('opciones_cliente_casos').style.display = 'block';
                    document.getElementById('opciones_citas').style.display = 'none';
                    document.getElementById('opciones_abogado').style.display = 'none';
                } else if (filtroCitas === 'clientes') {
                    document.getElementById('opciones_cliente_casos').style.display = 'block';
                    document.getElementById('opciones_citas').style.display = 'none';
                    document.getElementById('opciones_abogado').style.display = 'none';
                } else {
                    document.getElementById('opciones_cliente_casos').style.display = 'none';
                    document.getElementById('opciones_citas').style.display = 'none';
                    document.getElementById('opciones_abogado').style.display = 'none';

                }
            }
        });
        document.getElementById('filtro_citas').addEventListener('change', function() {
            var filtroCitas = this.value;
            if (filtroCitas === 'por_abogado') {
                document.getElementById('opciones_abogado').style.display = 'block';
            } else {
                document.getElementById('opciones_abogado').style.display = 'none';
            }
        });
        document.getElementById('filtro_cliente_casos').addEventListener('change', function() {
            var filtroClienteCasos = this.value;
            if (filtroClienteCasos === 'por_abogado') {
                document.getElementById('opciones_abogado').style.display = 'block';
                document.getElementById('opciones_citas').style.display = 'none';

            } else {
                document.getElementById('opciones_abogado').style.display = 'none';
            }
        });
        // Animación para la tabla de citas
        document.querySelector('.table').classList.add('animated', 'fadeIn');
    </script>
@stop
