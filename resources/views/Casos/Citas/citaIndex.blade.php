@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <img src="/storage/cita.png" alt="">
@stop

@section('content')

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            @if (Auth::user()->rol == 'abogado')
                <button type="button" class="btn btn-lg bg-gradient-primary btn-lg ">
                    <a href="{{ route('citas.create', $caso_id) }} " class="text-white">
                        Nueva cita
                    </a>
                </button>
            @endif
            <form class="form-inline">
                <div class="input-group ">
                    <input type="search" class="form-control form-control-lg" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-5">
        @foreach ($citas as $cita)
            <div class="col mb-3">
                <div class="align-items-center">
                    <div>
                        <h5 class="mb-1" style="background-color: lightsteelblue; padding: 5px; border-radius: 5px;">
                            {{ $cita->descripcion }}
                        </h5>
                        <p class="mb-1"><span style="color: blue;">Abre:</span> {{ $cita->fecha_creacion }}</p>
                        <p class="mb-1"><span style="color: red;">Expira:</span> {{ $cita->fecha_cierre }}</p>
                    </div>
                    <div>
                        <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-sm btn-info mr-4"><i
                                class="fas fa-eye"></i>
                        </a>
                        @if (Auth::user()->rol == 'abogado')
                            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-sm btn-warning mr-4"><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ route('citas.destroy', $cita->id) }}" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash"></i></a>                           
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('css')
    <style>
        .list-group-item-action:hover {
            background-color: lightblue;
        }

        .input-group {
            width: auto;
            /* Ajusta el ancho del formulario de búsqueda */
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
