<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabinete de Abogados</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animaciones CSS personalizadas -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('storage/img_4.jpg'); /* Cambia 'background-image.jpg' por la ruta de tu imagen de fondo */
            background-size: cover;
            background-position: center;
        }
        .content {
            text-align: center;
            color: #fff;
            animation: fadeIn 2s ease-out; /* Animación de entrada */
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="content py-5">
                    <h1 class="display-4">NOSOTROS LUCHAMOS POR LA JUSTICIA</h1>
                    <p class="lead">Servicios legales de calidad para empresas y particulares.</p>
                    @if (Route::has('login'))
                    <div class="mt-4">
                        @auth
                        <a href="{{ url('/home') }}" class="btn btn-success btn-lg">Ir al Panel de Control</a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Iniciar sesión</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Registrarse</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
