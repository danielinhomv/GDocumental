@extends('adminlte::page')

@section('title', 'Ver Cita')

@section('content_header')
@stop
@section('content')
    <div class="card card-widget">
        <div class="card-header">
            <div class="user-block">

                <a href="{{ route('citas.usuarioAbogado', $cita->abogado_id) }}">
                    <img class="img-circle" src="/storage/usuario.png" alt="">
                    </img>
                </a>

                <span class="username">
                    <a href="{{ route('citas.usuarioAbogado', $cita->abogado_id) }}">Abog.
                        {{ $abogado->nombre_completo }}
                    </a>
                </span>
                <span class="description">Shared publicly - {{ $cita->fecha_creacion }}</span>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <p>
                {{ $cita->nota_adicional }}
            </p>
            <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
            <span class="float-right text-muted">2 comments</span>
        </div>
        <div class="card-footer card-comments">
            <div class="card-comment">
                <img class="img-circle img-sm" src="/storage/usuario.png" alt="User Image">
                <div class="comment-text">
                    <span class="username">
                        Nora Havisham
                        <span class="text-muted float-right">8:03 PM Today</span>
                    </span>
                    The point of using Lorem Ipsum is that it hrs a morer-less
                    normal distribution of letters, as opposed to using
                    'Content here, content here', making it look like readable English.
                </div>
            </div>
            <div class="card-comment">
                <img class="img-circle img-sm" src="/storage/usuario.png" alt="User Image">
                <div class="comment-text">
                    <span class="username">
                        Abog. {{ $abogado->nombre_completo }}
                        <span class="text-muted float-right">8:03 PM Today</span>
                    </span>
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="#" method="post">
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </span>
                </div>
            </form>
        </div>

    </div>
@stop

@section('js')
    <script></script>
@stop
