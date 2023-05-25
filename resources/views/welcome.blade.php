<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mundifood</title>
        
        <link rel="stylesheet" href="{{ asset('css/welcome.css')}}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">       
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar sesión</a>
                        <a href="{{ route('register') }}">Registro</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Mundif00d
                </div>
                <div class="subtitle m-b-md">
                    <p id="subtitle">¡Cómete el mundo!<br/>
                    <img id="logo" src="/images/logo.jpg" alt="logo"></p>
                </div>
                                
                <div class="gallery">
                    <a href="#">
                        <img class="card" src="/images/japan.jpg" alt="Japón">
                    </a>
                    <div class="desc">Japón</div>
                </div>

                <div class="gallery">
                    <a href="#">
                        <img class="card" src="/images/spain.jpg" alt="España">
                    </a>
                    <div class="desc">España</div>
                </div>

                <div class="gallery">
                    <a href="#">
                        <img class="card" src="/images/rusia.jpg" alt="Rusia">
                    </a>
                    <div class="desc">Rusia</div>
                </div>

                <div class="gallery">
                    <a href="#">
                        <img class="card" src="/images/uk.jpg" alt="Reino Unido">
                    </a>
                    <div class="desc">Inglaterra</div>
                </div>

                <div class="links">                   
                    <a href="/menu">Nuestra Carta</a>
                    <a href="/news">Novedades y noticias</a>
                    <a href="/who">Quiénes somos</a>
                    <a href="/work">Trabaja con nosotros</a>
                    <a href="/FAQS">Preguntas y respuestas frecuentes</a>
                </div>                
            </div>
        </div>
    </body>
</html>
