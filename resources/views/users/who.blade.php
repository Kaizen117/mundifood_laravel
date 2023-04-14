@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">            
                <!-- <a href="{{ url('/') }}" class="btn btn-link">Volver al index</a> -->
                <h1 class="text-center text-mute"><u>Quiénes somos</u></h1>
                <br/>
                <h3>Somos una empresa startup que nos apasiona la cocina, los viajes y la buena gastronomía.
                    Es por ello que hemos probado gran variedad de platos por todo el mundo y se nos ocurrió la gran idea de traer dichos platos a nuestra tierra, ¡con una calidad excelente y
                    buenos cocineros que sean capaces de prepararla! ¿Te atreves a comerte el mundo?
                </h3>

                <h3>Visítanos en nuestras redes sociales y que tu boca se te haga agua:</h3>
                <ul>
                    <li><a>Instagram</a></li>     
                    <li><a>Facebook</a></li>
                    <li><a>Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>

    @include('footer')

@endsection