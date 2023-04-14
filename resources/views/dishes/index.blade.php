<head> <link rel="stylesheet" href={{ asset('css/dishes.css')}}> </head>

@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">            
                <h1 class="text-center text-mute"><u> {{ __("Platos") }} </u></h1>
                <br/>
                @if(auth()->user()->type=='admin') 
                    <a class="btn btn-primary" role="button" href="/dishes/new">Insertar nuevo plato</a>
                    <span id="contPages">Mostrando <b>10</b> platos por página.</span>
                    <form action="{{ route('register') }}" method="POST">
                        {{ csrf_field() }}                   
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Disponibilidad</th>                                                       
                                </tr>
                            </thead>                                                     
                            @forelse($dishes as $dish)              
                                <tbody>
                                    <tr>
                                        <td>{{ $dish->name }}</td>
                                        <td>{{ $dish->image }}</td>
                                        <td>{{ $dish->price }}</td>
                                        <td>{{ $dish->description }}</td>
                                        <td>{{ $dish->category }}</td>
                                        <td>{{ $dish->disponibility }}</td>                                
                                        <td><a class="btn btn-primary" href="{{ url('/dishes/edit/' . $dish->id) }}" title="Editar este plato"><i class="fas fa-edit"></i> Editar</a></td>
                                        <td><a class="btn btn-danger" href="{{ url('/dishes/delete/' . $dish->id) }}" title="ELIMINAR PLATO"><i class="fas fa-trash-alt"></i> Eliminar</a></td>
                                    </tr>                              
                                </tbody>                           
                            @empty
                                <br/>
                                <div class="alert alert-danger">
                                    {{ __("No hay ningún plato") }}
                                </div>  
                            @endforelse                         
                        </table>                    
                    </form>
                    <div class="text-center">
                        @if($dishes->count())
                            {{ $dishes->links() }}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('footer')
@endsection