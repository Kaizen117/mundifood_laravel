@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">            
                <!-- <a href="{{ url('/') }}" class="btn btn-link">Volver al index</a> -->
                <h1 class="text-center text-mute"><u>Novedades y notícias</u></h1>
                <br/>
                <h3>¡No te pierdas nuestros nuevos platos! Suscríbete a nuestro <b>Newsletter</b> para saber de las últimas noticias y novedades.</h3>

                <h2>22/04/2023</h2>
                <ul>
                    <li>Tenemos un nuevo plato en nuestras cocinas, <span style="color: red;">¡Bolitas de Pulpo Teriyaki!</span></li>     
                    <li>El clásico mas clasico español. <span style="color: red;">¡Tortilla de patatas!</span> ¿A qué esperas?</li>
                    <li>¿Alguien dijo cremosidad? <span style="color: red;">¡Tarta de queso!</span> con frutos rojos recien salida del horno!</li>
                </ul>
                <h2>19/05/2023</h2>
                <ul>
                    <li>Un nuevo clásico ha entrado por la puerta. ¡Volvemos a tener <span style="color: red;">Ron cola</span> para servir!</li>                                             
                </ul>                
                <h2>20/05/2023</h2>
                <p style="font-size: 24px;">ESTAMOS DE CELEBRACIÓN, <span style="color: red;">¡¡¡MUNDIFOOD CUMPLE HOY SU PRIMER AÑO DE INAUGURACIÓN!!!</span> Para celebrarlo vamos a sortear en nuestras redes sociales varios cupones promocionales con grandes descuentos, ¡no te los pierdas!</p>
                
                <br/><br/>
            </div>
        </div>
    </div>

    @include('footer')

@endsection