<head> <link rel="stylesheet" href={{ asset('css/faqs.css')}}> </head>

@extends('layouts.app')
@section('content')
    <div class="row">        
        <div id="questions" class="container">                               
            <div class="col-md-15">            
                <h1 class="text-center text-mute"><u>Preguntas frecuentes (FAQs)</u></h1>
                <br/><br/>
                <ul>
                    <li><a onClick="toggleHidden('#question1')"><i>He tenido un problema con una reserva, ¿qué puedo hacer?</i></a></li>
                    <div id="question1" hidden>LLame al télefono del local donde resida. Si el problema es interno, póngase en contacto con el administrador en el siguiente correo explicándole su problema.<br/><a>admin@admin.com</a></div>                                       
                </ul>
                <ul>
                    <li><a onClick="toggleHidden('#question2')"><i>Me gustaría eliminar mi cuenta, pero no encuentro cómo hacerlo</i></a></li>
                    <div id="question2" hidden>Póngase en contacto con el administrador en el siguiente correo explicándole su problema.<br/><a>admin@admin.com</a><br/>¡Lamentamos que te vayas!
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-frown" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
                    </svg>
                    </div>                                       
                </ul>
                <ul>
                    <li><a onClick="toggleHidden('#question3')"><i>Solía pedir un plato muy habitual, pero ha sido descatalogado de la carta. ¿Volverán esta clase de platos?</i></a></li>
                    <div id="question3" hidden>¡Sí! En general hay platos que solo se mantienen durante un periodo de tiempo determinado, pero no significa que no vuelvan a estar disponibles. ¡Pon atención a nuestro apartado de novedades y redes sociales para estar informado de nuestros cambios!</a></div>                                       
                </ul>
                <ul>
                    <li><a onClick="toggleHidden('#question4')"><i>Me gusta la variedad de la carta, pero hay platos típicos del país que no están en ella.</i></a></li>
                    <div id="question4" hidden>Consideramos que hay decenas de platos típicos de cada país del mundo, pero nuestro objetivo es demostrar que la receta es lo más parecida posible a la real. Estamos investigando nuevas recetas que podamos implementar pero queremos que haya una variedad considerable para cada país y no abusar de los platos más populares, del mismo modo que para sacar dicho plato nos basamos en su popularidad de otros medios de información.</a></div>                                       
                </ul>                
            </div>
        </div>
    </div>

    @include('footer')
    
    <script>
        function toggleHidden(selector) {
            element = document.querySelector(selector);
            element.hidden = element.hidden ? false : true;
        }
    </script>
@endsection