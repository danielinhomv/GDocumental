@extends('adminlte::page')

@section('title', 'Chat')

@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12">
                <div class="card card-primary card-outline direct-chat direct-chat-primary h-100">
                    <div class="card-header">
                        <h3 class="card-title">Direct Chat</h3>
                    </div>

                    <div class="card-body" id="chat-messages">
                        @foreach ($comentarios as $comentario)
                            <div class="direct-chat-msg {{ $comentario->user_id == Auth::id() ? 'right' : '' }}">
                                <div class="direct-chat-info clearfix">
                                    <span
                                        class="direct-chat-name {{ $comentario->user_id == Auth::id() ? 'float-right text-primary' : 'float-left text-secondary' }}">
                                        {{ $comentario->user_id == Auth::id() ? 'You' : $comentario->user->nombre_completo }}
                                    </span>
                                    <span
                                        class="direct-chat-timestamp {{ $comentario->user_id == Auth::id() ? 'float-left' : 'float-right' }}">
                                        {{ $comentario->fecha }}
                                    </span>
                                </div>
                                <div
                                    class="direct-chat-text {{ $comentario->user_id == Auth::id() ? 'bg-primary text-white' : 'bg-light text-dark' }} small">
                                    {{ $comentario->mensaje }}
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="card-footer">
                        <form id="send-message-form" action="{{ route('citas.send', $cita_id) }}" method="post">
                            @csrf
                            <input type="hidden" name="cita_id" value="{{ $cita_id }}">
                            <div class="input-group">
                                <input required type="text" name="message" placeholder="Type Message ..."
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        #chat-messages {
            max-height: 70vh;
            /* Altura máxima del chat igual a la altura de la ventana */
            overflow-y: auto;/
        }

        .direct-chat-info i {
            margin-right: 10px;
        }

        .direct-chat-text {
            border-radius: 20px;
            padding: 10px 15px;
            max-width: 60%;
        }

        .right .direct-chat-text {
            float: right;
            background-color: #d1e7dd;
            /* Light green background */
            color: #0f5132;
            /* Dark green text */
        }

        .small {
            font-size: 0.875rem;
        }

        .direct-chat-msg.right .direct-chat-info {
            text-align: right;
        }

        .direct-chat-msg.right .direct-chat-name {
            float: right;
        }

        .direct-chat-msg.right .direct-chat-timestamp {
            float: left;
        }
    </style>
@stop

@section('js')
    @vite('resources/js/app.js')
    <script>
                                const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;

        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('send-message-form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault(); // Prevenir la recarga de la página

                const formData = new FormData(form);
                const url = form.action;
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                        },
                        body: formData
                    });

                    if (response.ok) {
                        // Limpiar el campo de entrada
                        form.reset();
                    } else {
                        console.error('Error en la respuesta del servidor:', response.statusText);
                    }
                } catch (error) {
                    console.error('Error en el envío del mensaje:', error);
                }
            });

            initializeEcho();
        });

        function initializeEcho() {
            if (window.Echo) {
                console.log('Echo inicializado');
                window.Echo.channel('comentario-cita')
                    .listen('.comentario', (e) => {
                        console.log(e);
                        const chatMessages = document.getElementById('chat-messages');

                        // Aquí puedes agregar el mensaje nuevo al chat
                        const newMessage = document.createElement('div');
                        newMessage.classList.add('direct-chat-msg');

                        var userId = {{ Auth::id() }};
                        var messageUserId = e.user_id;

                        if (userId === messageUserId) {
                            newMessage.classList.add('right');
                            newMessage.innerHTML = `
                         <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name float-right text-primary">You</span>
                            <span class="direct-chat-timestamp float-left">${new Date().toLocaleTimeString()}</span>
                        </div>
                        <div class="direct-chat-text bg-primary text-white small">${e.mensaje}</div>
                         `;
                        } else {
                            newMessage.innerHTML = `
                         <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name float-left text-secondary">${e.nombre_completo}</span>
                            <span class="direct-chat-timestamp float-right">${new Date().toLocaleTimeString()}</span>
                        </div>
                        <div class="direct-chat-text bg-light text-dark small">${e.mensaje}</div>
                         `;
                        }

                        chatMessages.appendChild(newMessage);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    });
            } else {
                console.log('Echo no está disponible, volviendo a intentar en 200ms');
                setTimeout(initializeEcho, 200);
            }
        }
    </script>
@stop
