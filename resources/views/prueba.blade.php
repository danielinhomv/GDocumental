<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

</body>
@vite('resources/js/app.js')
<script>
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

</html>
