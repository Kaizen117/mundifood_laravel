@extends('layouts.app')
@section('content')
    <br/>
    <h1 class="text-center text-mute"><u>Nuestra carta</u></h1>
    <br/>
    <div class="container">
        <h4 class="text-center text-mute">En Mundofood somos exigentes a la hora de preparar un plato. Elegir los ingredientes adecuados y de calidad selecta para cada receta del mundo requieren una experiencia laboral y profesional.
            Es por ello que nuestra carta esta pensadá para todo tipo de paladares tanto principiantes como veteranos. ¡Echale un vistazo y pídete algo!
        </h4>
        <br/>
        <p class="text-center text-mute"><a class="btn btn-primary" role="button" href="/mundifood_menu">Ver carta en PDF</a></p>
        <br/>
    </div>
    @include('footer')
@endsection