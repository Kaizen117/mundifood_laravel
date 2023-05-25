<head>
    <link rel="stylesheet" href="{{ asset('css/indexCrud.css') }}">
</head>

@extends('layouts.app')
@section('content')
    <div class="row">        
        <div class="container">                               
            <div class="col-md-15">            
                <h1 class="text-center text-mute">{{ __("Reservas") }}</h1>
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
                    
                <a class="btn btn-primary" role="button" href="/reserves/new">Añadir nueva reserva</a>
                <p id="contPages">Mostrando <span id="cant">10</span> reservas por página ordenados por fecha y hora ascendente.</p>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr><br/><br/>
                                <th scope="col">Número de mesa</th>
                                <th scope="col">Usuario que realizó la reserva</th>
                                <th scope="col">Número de comensales invitados</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        
                        @forelse($reserves as $reserve)
                            <tbody>
                                <tr>
                                    <td>{{ $reserve->table_id }}</td>
                                    <td>{{ $reserve->user->name }} {{ $reserve->user->surname1 }} {{ $reserve->user->surname2 }}</td>
                                    <td>{{ $reserve->diner_number }}</td>
                                    <td>{{ $reserve->date }}</td>
                                    <td>{{ $reserve->hour }}</td>
                                    <td>{{ $reserve->observations }}</td>
                                    <td>
                                        <a class="btn btn-primary" id="editar" href="{{ url('/reserves/edit/' . $reserve->id) }}" title="Editar reserva"><i class="fas fa-edit"></i> Editar</a>
                                        <a class="btn btn-danger" id="eliminar" title="ELIMINAR RESERVA" data-toggle="modal" data-target="#exampleModal-{{$reserve->id}}"><i class="fas fa-trash-alt"></i> Eliminar</a>                      
                                        <div class="modal fade" id="exampleModal-{{$reserve->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Reserva</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar la reserva {{$reserve->id}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-danger" href="{{ url('/reserves/delete/' . $reserve->id) }}">Borrar</i></a>
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
                                {{ __("No hay ninguna reserva") }}
                            </div>  
                        @endforelse
                    </table>
                    
                <div class="text-center">
                    @if($reserves->count())
                        {{ $reserves->links() }}
                    @endif
                </div>                
            </div>
        </div>
    </div>
    @include('footer')
@endsection