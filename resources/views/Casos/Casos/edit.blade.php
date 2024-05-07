@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<img src="/storage/casos.png" alt="">
@stop

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Editar caso</h5>

            <div class="container mt-4">
                <form method="post" action="{{ route('casos.update', $user->id) }}">
                    @method('patch')
                    @csrf
                
                    <div class="mb-3">
                        <label for="name" class="form-label">nombre del caso</label>
                        <input value="{{ $user->nombre }}" type="text" class="form-control" name="nombre" placeholder="Name"
                            required>

                        @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input value="{{ $user->descripcion }}" type="text" class="form-control" name="descripcion" placeholder="descripcion"
                            required>

                        @if ($errors->has('descripcion'))
                        <span class="text-danger text-left">{{ $errors->first('descripcion') }}</span>
                        @endif
                    </div>
                    
                    
                    

                    <button type="submit" class="btn btn-primary">Update user</button>
                    <a href="{{ route('casos.index') }}" class="btn btn-default">Cancel</button>
                </form>
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
