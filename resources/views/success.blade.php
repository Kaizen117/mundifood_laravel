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
                        Por favor verifique su email al correo que nos ha proporcionado.
                    </div>
                @endauth                    
                <div class="panel-body">                                    
                    <a href="/">Ir a la página de bienvenida</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')
@endsection
