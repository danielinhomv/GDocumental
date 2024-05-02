@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<img src="/storage/hombre_abogado.png" alt="">
@stop

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">list of lawyers</h3>
                <div class="card-tools">
                    <form role="form" action="{{ route('company_abogado_users.search') }}" method="POST"
                        class="input-group input-group-sm" style="width: 150px;">
                        @csrf
                        <input type="text" name="search" class="form-control float-right " placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap table table-bordered"">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre completo</th>
                            <th>Email</th>
                            <th>Direccion</th>
                            <th>telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if ($abogados->count() === 0)
                                <tr>
                                    <td colspan="6" class="text-center">No se econtraron resultados</td>
                                </tr>
                            @else
                                @foreach ($abogados as $abogado)
                                    <tr>
                                        <td>{{ $abogado->id }}</td>
                                        <td>{{ $abogado->nombre_completo }}</td>
                                        <td>{{ $abogado->email }}</td>
                                        <td>{{ $abogado->direccion }}</td>
                                        <td>{{ $abogado->telefono }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group mb-2 mt-n2">
                                                <a class="btn btn-dark"
                                                    href="{{ route('company_abogado_users.show', $abogado->id) }}">Show</a>
                                                <a class="btn btn-primary"
                                                    href="{{ route('company_abogado_users.edit', $abogado->id) }}">Edit</a>
                                                <form action="{{ route('company_abogado_users.destroy', $abogado->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary">
                    <a href="{{ route('company_abogado_users.create') }}" class="text-white">New</a>
                </button>
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
