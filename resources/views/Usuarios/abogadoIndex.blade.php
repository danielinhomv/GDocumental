@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lawyers</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">list of lawyers</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre completo</th>
                            <th>Registro</th>
                            <th>Direccion</th>
                            <th>telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($companyUsers->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No hay registros</td>
                            </tr>
                        @else
                            @foreach ($companyUsers as $companyUser)
                                <tr>
                                    <td>{{ $companyUser->id }}</td>
                                    <td>{{ $companyUser->nombre_completo }}</td>
                                    <td>{{ $companyUser->direccion }}</td>
                                    <td>{{ $companyUser->telefono }}</td>
                                    <a class="btn btn-dark"
                                        href="{{ route('company_abogado_users.show', $companyUser->id) }}"
                                        class="btn btn-info">Show</a>
                                    <a class="btn btn-primary"
                                        href="{{ route('company_abogado_users.edit', $companyUser->id) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form action="{{ route('company_abogado_users.destroy', $companyUser->id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
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
