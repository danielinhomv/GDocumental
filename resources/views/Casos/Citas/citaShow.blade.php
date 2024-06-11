@extends('adminlte::page')

@section('title', 'Ver Cita')

@section('content_header')
@stop
@section('content')
   
@stop

@section('js')
    <script>
            console.log("Hi, I'm using the Laravel-AdminLTE package!");

function initializeEcho() {
    // Verificar si Echo está disponible
    if (window.Echo) {
        console.log('Echo inicializado');
        window.Echo.channel('testing')
            .listen('.comentario', (e) => {
                console.log(e);
                // // Obtener el área de texto
                // const output = document.getElementById('output');

                // // Mostrar el contenido del atributo data en el área de texto
                // if (e.data) {
                //     output.value += e.data + '\n';
                // } else {
                //     output.value += 'No hay contenido de datos\n';
                // }
            });
    } else {
        console.log('Echo no está disponible, volviendo a intentar en 200ms');
        // Volver a intentarlo después de 200ms si Echo no está disponible aún
        setTimeout(initializeEcho, 200);
    }
}

// Inicializar Echo cuando el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', (event) => {

    initializeEcho();
});
    </script>
@stop
