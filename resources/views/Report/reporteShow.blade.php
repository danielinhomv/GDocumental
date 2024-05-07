@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <img src="/storage/admin.png" alt="">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
        integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.js"></script>

@stop

@section('content')

    <!-- Contenido de la página -->
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
                            <button type="button" class="btn btn-outline-light" id="generarPdfButton">
                                <img src="/storage/reporte.png"></img>
                            </button>
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
                            @if ($respuesta->count() == 0)
                                <p>No se encontraron resultados.</p>
                            @else
                                @switch($tipoReporte)
                                    @case('clientes')
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th title="Field #1">Nombre completo</th>
                                                    <th title="Field #2">Direccion</th>
                                                    <th title="Field #3">Telefono</th>
                                                    <th title="Field #4">estado</th>
                                                    <th title="Field #5">email</th>
                                                    <th title="Field #6">Nota adicional</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($respuesta as $caso)
                                                    <tr>
                                                        <td>{{ $caso->nombre_completo }}</td>
                                                        <td>{{ $caso->direccion }}</td>
                                                        <td>{{ $caso->telefono }}</td>
                                                        @if ($caso->eliminado)
                                                            <td>Inactivo</td>
                                                        @else
                                                            <td>Activo</td>
                                                        @endif
                                                        <td>{{ $caso->email }}</td>
                                                        @if ($caso->nota_adicional === null)
                                                            <td>No tiene</td>
                                                        @else
                                                            <td>{{ $caso->nota_adicional }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <!-- Agregar más filas según sea necesario -->
                                            </tbody>
                                        </table>
                                    @break

                                    @case('casos')
                                        <table class="table table-bordered table-hover" >
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Abogado</th>
                                                    <th>Cliente</th>
                                                    <th>Nombre</th>
                                                    <th>Descripcion</th>
                                                    <th>Nota adicional</th>
                                                    <th>estado</th>
                                                    <th>apertura</th>
                                                    <th>Cierre</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($respuesta as $caso)
                                                    <tr>
                                                        <td>{{ $caso->abogado }}</td>
                                                        <td>{{ $caso->cliente }}</td>
                                                        <td>{{ $caso->nombre }}</td>
                                                        <td>{{ $caso->descripcion }}</td>
                                                        @if ($caso->nota_adicional === null)
                                                            <td>No tiene</td>
                                                        @else
                                                        <td>{{$caso->nota_adicional}}</td>
                                                        @endif
                                                        @if ($caso->eliminado)
                                                            <td>Inactivo</td>
                                                        @else
                                                            <td>Activo</td>
                                                        @endif
                                                        <td>{{ $caso->fecha_apertura }}</td>
                                                        <td>{{ $caso->fecha_cierre }}</td>
                                                    </tr>
                                                @endforeach
                                                <!-- Agregar más filas según sea necesario -->
                                            </tbody>
                                        </table>
                                    @break

                                    @default
                                     <table class="table table-bordered table-hover" >
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Abogado</th>
                                                    <th>Cliente</th>
                                                    <th>Descripcion</th>
                                                    <th>Nota adicional</th>
                                                    <th>estado</th>
                                                    <th>apertura</th>
                                                    <th>Cierre</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($respuesta as $cita)
                                                    <tr>
                                                        <td>{{ $cita->abogado }}</td>
                                                        <td>{{ $cita->cliente }}</td>
                                                        <td>{{ $cita->descripcion }}</td>
                                                        @if ($cita->nota_adicional === null)
                                                            <td>No tiene</td>
                                                        @else
                                                            <td>{{$cita->nota_adicional}}</td>
                                                        @endif
                                                        @if ($cita->eliminado)
                                                            <td>Inactivo</td>
                                                        @else
                                                            <td>Activo</td>
                                                        @endif
                                                        <td>{{ $cita->fecha_creacion }}</td>
                                                        <td>{{ $cita->fecha_cierre }}</td>
                                                    </tr>
                                                @endforeach
                                                <!-- Agregar más filas según sea necesario -->
                                            </tbody>
                                        </table>
                                @endswitch
                        </div>
                        @endif

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
        document.querySelector('.table').classList.add('animated', 'fadeIn');

        document.getElementById('generarPdfButton').addEventListener('click', function() {
            var respuesta = {!! $respuesta !!};
            var doc = new jsPDF();
            var startY = 20; // Posición inicial en la página

            // Función para agregar contenido a la página
            function addContentToPage(content) {
                doc.text(20, startY, content);
                startY += 4; // Ajuste vertical
                if (startY >= 280) { // Verificar si hay suficiente espacio en la página actual
                    doc.addPage(); // Agregar una nueva página
                    startY = 20; // Reiniciar la posición inicial en la nueva página
                }
            }
            // Iterar sobre cada objeto en la respuesta
            respuesta.forEach(function(item) {
                for (var key in item) {
                    doc.setFontSize(10); 
                    addContentToPage(key + ': ' + item[key]);
                }
                addContentToPage('--------------------------------------------'); // Añadir separador
            });

            // Guardar el PDF
            doc.save('reporte.pdf');
        });
    </script>
@stop
