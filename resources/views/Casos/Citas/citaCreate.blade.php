@extends('adminlte::page')

@section('title', 'Crear Cita')

@section('content_header')
    <img src="/storage/cita.png" alt="" width="50">
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nueva Cita</h3>
            </div>
            <div class="card-body">
                <div id="audio-controls">
                    <button id="start-recording" class="btn btn-primary">Iniciar Grabación</button>
                    <button id="stop-recording" class="btn btn-danger" disabled>Detener Grabación</button>
                </div>
                <div id="audio-player" style="display: none;">
                    <audio id="recorded-audio" controls></audio>
                    <button id="play-audio" class="btn btn-success">Reproducir</button>
                </div>
                <form id="cita-form" action="{{ route('citas.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="audio-input" name="audio" required>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción de la cita"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
                    </div>

                    <div class="form-group" data-select2-id="29">
                        <label>Caso</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                            <option selected="selected" data-select2-id="3">Alabama</option>
                            <option data-select2-id="33">Alaska</option>
                            <option data-select2-id="34">California</option>
                            <option data-select2-id="35">Delaware</option>
                            <option data-select2-id="36">Tennessee</option>
                            <option data-select2-id="37">Texas</option>
                            <option data-select2-id="38">Washington</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Cita</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const startRecordingButton = document.getElementById('start-recording');
        const stopRecordingButton = document.getElementById('stop-recording');
        const playAudioButton = document.getElementById('play-audio');
        const audioPlayer = document.getElementById('recorded-audio');
        const audioInput = document.getElementById('audio-input');
        const citaForm = document.getElementById('cita-form');

        let mediaRecorder;
        let audioChunks = [];

        startRecordingButton.addEventListener('click', () => {
            navigator.mediaDevices.getUserMedia({
                    audio: true
                })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.start();
                    console.log('Grabación iniciada');
                    startRecordingButton.disabled = true;
                    stopRecordingButton.disabled = false;

                    mediaRecorder.addEventListener('dataavailable', event => {
                        audioChunks.push(event.data);
                    });

                    // Mover aquí la parte del código del evento 'stop'
                    mediaRecorder.addEventListener('stop', () => {
                        console.log('Grabación detenida, activando botón de reproducir');
                        const audioBlob = new Blob(audioChunks);
                        const audioUrl = URL.createObjectURL(audioBlob);
                        audioPlayer.src = audioUrl;
                        audioInput.value = audioBlob;

                        // Asegurar que el reproductor de audio se muestre
                        document.getElementById('audio-player').style.display = 'block';

                        playAudioButton.style.display = 'inline-block';
                        citaForm.style.display = 'block';
                        console.log('Mostrando botón de reproducción y reproductor de audio');
                    });

                })
                .catch(console.error);
        });


        stopRecordingButton.addEventListener('click', () => {
            mediaRecorder.stop();
            startRecordingButton.disabled = false;
            stopRecordingButton.disabled = true;
            playAudioButton.disabled = false;
            console.log('stop')
        });

        playAudioButton.addEventListener('click', () => {
            audioPlayer.play();
            console.log('play')
        });
    </script>
@stop
