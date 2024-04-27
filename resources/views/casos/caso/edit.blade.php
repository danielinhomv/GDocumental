@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Update caso</h5>

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
                    <div class="mb-3">
                        <label for="estado" class="form-label">estado</label>
                        <input value="{{ $user->estado }}" type="text" class="form-control" name="estado" placeholder="estado"
                            required>

                        @if ($errors->has('descripcion'))
                        <span class="text-danger text-left">{{ $errors->first('descripcion') }}</span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Abogado</label>
                        <select name="abogado_id" id="abogado_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        @foreach ($userAbogado as $item)
                            <option value = "{{ $item['id'] }}" > {{$item['nombre']}}</option>
                        @endforeach
                        </select>
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
