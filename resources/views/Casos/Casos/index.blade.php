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
                        <a href="{{ route('casos.create') }}" class="btn btn-primary btn-sm float-right">Add user</a>
                        @endif
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    @if(Auth::user()->rol == 'empresa' )
                                    <th>Nombre de abogado</th>
                                    <th>nombre de cliente</th>
                                    @endif
                                    @if(Auth::user()->rol == 'cliente' )
                                    <th>Nombre de abogado</th>
                                    @endif
                                    
                                    @if(Auth::user()->rol == 'abogado' )
                                    <th>Nombre de cliente</th>
                                    @endif
                                    <th>nombre del Caso</th>
                                    <th>descripcion</th>
                                    <th>estado</th>
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
                                        <td><a href="{{ route('casos.show', $dato['id']) }}" class="btn btn-warning btn-sm">Show</a></td>
                                        <td><a href="{{ route('casos.edit', $dato['id']) }}" class="btn btn-info btn-sm">Edit</a></td>
                                        <td><form action="{{ route('casos.destroy', $dato['id']) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                        </form></td>
                                        <td>
                                            <a href="{{ route('citas.index', $dato['id'] ) }}" class="btn btn-info btn-sm">cita
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm">docu</a>
                                        </td>
                                        
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