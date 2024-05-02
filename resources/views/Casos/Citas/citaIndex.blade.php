@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <img src="/storage/cita.png" alt="" width="50">
@stop

@section('content')

<div class="col-12">
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <button  type="button" class="btn btn-lg bg-gradient-primary btn-lg " >Primary</button>
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
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small>3 days ago</small>
                </div>
                <p class="mb-1">Some placeholder content in a paragraph.</p>
                <small>And some small print.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Some placeholder content in a paragraph.</p>
                <small class="text-muted">And some muted small print.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Some placeholder content in a paragraph.</p>
                <small class="text-muted">And some muted small print.</small>
            </a>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .list-group-item-action:hover {
            background-color: lightblue;
        }
        .input-group {
            width: auto; /* Ajusta el ancho del formulario de búsqueda */
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
