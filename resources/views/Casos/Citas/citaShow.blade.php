@extends('adminlte::page')

@section('title', 'Ver Cita')

@section('content_header')
    <img src="/storage/cita.png" alt="" width="50">
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ver Cita</h3>
            </div>
            <div class="card-body">
                <div id="audio-controls">
                    @if ($cita->audio)
                        <button id="play-audio" class="btn btn-success">Reproducir</button>
                    @else
                        <p>No hay audio disponible</p>
                    @endif
                </div>
                <div id="audio-player">
                    @if ($cita->audio)
                        <audio id="recorded-audio" controls>
                            <source src="{{ Storage::url($cita->audio) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @endif
                </div>
                <div class="form-group">
                    <label for="caso_id">Caso</label>
                    <input type="number" class="form-control" id="caso_id" name="caso_id" value="{{ $cita->caso_id }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" readonly>{{ $cita->descripcion }}</textarea>
                </div>
                <div class="form-group">
                    <label for="fecha_hora">Fecha y Hora</label>
                    <input type="text" class="form-control" id="fecha_hora" name="fecha_hora"
                        value="{{ $cita->fecha_hora }}" readonly>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const playAudioButton = document.getElementById('play-audio');
        const audioPlayer = document.getElementById('recorded-audio');

        if (playAudioButton) {
            playAudioButton.addEventListener('click', () => {
                audioPlayer.play();
            });
        }
    </script>
@stop
