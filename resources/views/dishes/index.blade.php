<head>
    <link rel="stylesheet" href="{{ asset('css/indexCrud.css') }}">
</head>

@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">            
                <h1 class="text-center text-mute">{{ __("Platos") }}</h1>
                <br/>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        Ocurrió un error inesperado.
                    </div>
                @endif
                    
                <a class="btn btn-primary" role="button" href="/dishes/new">Crear nuevo plato</a>
                <p id="contPages">Mostrando <span id="cant">10</span> platos por página ordenados alfabéticamente.</p>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr><br/><br/>
                                <th scope="col">Nombre</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Disponibilidad</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        @forelse($dishes as $dish)
                            <tbody>
                                <tr>
                                    <td>{{ $dish->name }}</td>
                                    <td><img src="{{ asset('images/dishes/' . $dish->image) }}" width="150px" height="150px" alt="plato"></td>
                                    <td>{{ $dish->price }}€</td>
                                    <td>{{ $dish->description }}</td>
                                    <td>{{ $dish->category }}</td>
                                    <td>@if($dish->disponibility == 1)
                                            <!--<input type="checkbox" checked disabled>-->
                                            <span class="green-tick">✔️ Sí</span> 
                                        @else
                                            <!--<input type="checkbox" disabled>-->
                                            <span class="red-denied">❌ No</span>
                                        @endif     
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" id="editar" href="{{ url('/dishes/edit/' . $dish->id) }}" title="Editar este plato"><i class="fas fa-edit"></i> Editar</a>
                                        <!--<a class="btn btn-danger" id="eliminar" href="{{ url('/dishes/delete/' . $dish->id) }}" title="ELIMINAR PLATO" onclick="return confirm('Estas apunto de eliminar el plato marcado')"><i class="fas fa-trash-alt"></i> Eliminar</a>-->
                                        <a class="btn btn-danger" id="eliminar" title="ELIMINAR PLATO" data-toggle="modal" data-target="#exampleModal-{{$dish->id}}"><i class="fas fa-trash-alt"></i> Eliminar</a>                      
                                        <div class="modal fade" id="exampleModal-{{$dish->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Plato</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar el plato {{ $dish->name }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-danger" href="{{ url('/dishes/delete/' . $dish->id) }}">Borrar</i></a>
                                                        <a data-dismiss="modal" class="btn btn-primary">Cancelar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @empty
                            <br/>
                            <div class="alert alert-danger">
                                {{ __("No hay ningún plato") }}
                            </div>  
                        @endforelse
                    </table>
                    
                    <div class="text-center">
                        @if($dishes->count())
                            {{ $dishes->links() }}
                        @endif
                    </div>
                
            </div>
        </div>
    </div>
    @include('footer')
@endsection