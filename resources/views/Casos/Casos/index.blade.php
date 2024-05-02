@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@method('DELETE')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mis Datos</div>
                    <div class="card-tools">
                        <form role="form" action="{{ route('casos.search') }}" method="POST"
                            class="input-group input-group-sm" style="width: 150px;">
                            @csrf
                            <input type="text" name="search" class="form-control float-right " placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
    

                    <div class="mb-2 text-end">
                        @if(Auth::user()->rol == 'abogado')
                        <a href="{{ route('casos.create') }}" class="btn btn-primary btn-sm float-right">Nuevo caso</a>
                        @endif
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    @if(Auth::user()->rol == 'empresa' )
                                    <th> abogado</th>
                                    <th> cliente</th>
                                    @endif
                                    @if(Auth::user()->rol == 'cliente' )
                                    <th> abogado</th>
                                    @endif
                                    
                                    @if(Auth::user()->rol == 'abogado' )
                                    <th> cliente</th>
                                    @endif
                                    <th>nombre del Caso</th>
                                    <th>descripcion</th>
                                    <th>estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $dato)
                                    <tr> 
                                        @if(Auth::user()->rol == 'empresa')
                                            <td>{{$dato['nombre_abogado']}} </td>
                                        @endif
                                        <td>{{$dato['nombre_cliente']}} </td>     
                                        <td>{{ $dato['nombre'] }}</td>
                                        <td>{{ $dato['descripcion'] }}</td>
                                        <td>{{ $dato['estado'] }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Acción</font></font></button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Alternar menú desplegable</font></font></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ route('casos.show', $dato['id']) }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Show</font></font></a></li>
                                                <li><a href="{{ route('casos.edit', $dato['id']) }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Edit</font></font></a></li>
                                                <li><a href="{{route('citas.index',$dato['id'])}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cita</font></font></a></li>
                                                <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Expediente</font></font></a></li>
                                                </ul>
                                                </div>
                                        </td>
                                        <td><form action="{{ route('casos.destroy', $dato['id']) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                        </form></td>
                                     
                                        
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
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