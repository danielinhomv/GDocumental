<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <textarea id="output" rows="10" cols="50"></textarea>
    @vite('resources/js/app.js')
    <script>
        // function initializeEcho() {

            // if (window.Echo) {

                window.Echo.channel('comentario-cita')
                .listen('.comentario', (e) => {
                    console.log(e);
                    // Obtener el área de texto
                    const output = document.getElementById('output');

                    // Mostrar solo el contenido del atributo data en el área de texto
                    if (e.data) {
                        output.value += e.data + '\n';
                    } else {
                        output.value += 'No data content\n';
                    }
                });
            // } else {
            //     setTimeout(initializeEcho, 200); // Vuelve a intentarlo después de 200ms
            // }
        // }

        // document.addEventListener('DOMContentLoaded', (event) => {
        //     initializeEcho();
        // });
    </script>
</body>
</html>
