@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @auth
                    <div class="alert alert-danger">
                        Usted ya está actualmente logueado.
                    </div>
                @else
                    <div class="alert alert-success">
                        ¡Exito! ¡Esperamos que disfrutes tu estancia tanto como tus próximos pedidos de comida!
                    </div>
                @endauth
                <div class="panel-body">
                    ¡Gracias por tu registro! Descarga nuestra app desde nuestros gestores oficiales de Apple Store y Google Play, ¡podrás usarla directamente sin necesidad de volver a registrarte!
                    <p><br/>Otros enlaces de interes: </p>
                    <ul>
                        <li><p><a href="/menu">Nuestra carta</a></p></li>
                        <li><p><a href="/news">Novedades y notícias</a></p></li>
                    </ul>
                    
                    
                    <a href="/">Ir a la página de bienvenida</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')
@endsection
